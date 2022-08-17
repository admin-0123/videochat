<?php

namespace App\Models;

use App\Enums\MeetingStatus;
use App\Events\MeetingStatusChanged;
use App\Events\MeetingRoomCreated;
use App\Events\PublicMeetingRoomCreated;
use App\Helpers\CalHelper;
use App\Helpers\IpHelper;
use App\Traits\HasMeta;
use App\Traits\HasUuid;
use App\Models\User;
use App\Models\Option;
use App\Notifications\MeetingIsEnded;
use App\Notifications\MeetingIsLive;
use App\Traits\ModelOption;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meeting extends Model implements HasMedia
{
    use HasMeta, HasUuid, ModelOption, InteractsWithMedia, HasFactory, LogsActivity;

    protected $guarded = [];
    protected $casts = [
        'meta' => 'array',
        'fee' => 'array',
        'start_date_time' => 'datetime'
    ];
    protected $table = 'meetings';
    protected static $logName = 'meeting';
    protected static $logFillable = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = [ 'updated_at'];
    protected $with = ['user', 'category'];
    protected static $sortOptions = ['created_at', 'keyword', 'start_date_time', 'updated_at'];
    protected static $defaultSortBy = 'start_date_time';

    // Relations
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Option::class, 'category_id');
    }

    public function invitees() : HasMany
    {
        return $this->hasMany(Invitee::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function getFee(string $option)
    {
        return Arr::get($this->fee, $option);
    }

    // Booted
    public static function booted()
    {
    }

    // Attributes
    public function getDiffForHumanAttribute()
    {
        $datetime = CalHelper::showDateTime($this->start_date_time);

        return Carbon::parse($datetime)->diffForHumans();
    }

    public function getPlannedStartDateTimeAttribute()
    {
        $snoozed_logs = $this->getMeta('snoozed_logs') ? : [];

        if (! $snoozed_logs) {
            return $this->start_date_time;
        }

        return Arr::get(Arr::first($snoozed_logs), 'start_date_time');
    }

    public function getIsPaidAttribute()
    {
        if ($this->getFee('is_paid')) {
            return true;
        }

        return false;
    }

    public function getHasPaidAttribute()
    {
        if (! $this->getFee('is_paid')) {
            return false;
        }

        if (! \Auth::check()) {
            return false;
        }

        if ($this->user_id == \Auth::id()) {
            return true;
        }

        if (\Auth::user()->is_premium) {
            return true;
        }

        if ($this->transactions->where('user_id', \Auth::id())->where('status', 1)->first()) {
            return true;
        }

        return false;
    }

    // Constrains

    public function ensureNotCancelled() : void
    {
        if ($this->getMeta('status') === MeetingStatus::CANCELLED) {
            throw ValidationException::withMessages(['message' => __('meeting.invalid_action_with_status', ['attribute' => trans('meeting.status.'. $this->getMeta('status'))])]);
        }
    }

    public function ensureIsLive() : void
    {
        if ($this->getMeta('status') != MeetingStatus::LIVE) {
            throw ValidationException::withMessages(['message' => __('meeting.invalid_action_with_status', ['attribute' => trans('meeting.status.'. $this->getMeta('status'))])]);
        }
    }

    public function ensureIsNotEnded() : void
    {
        if ($this->getMeta('status') === MeetingStatus::ENDED) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }
    }

    public function ensureIsScheduled() : void
    {
        if ($this->getMeta('status') != MeetingStatus::SCHEDULED) {
            throw ValidationException::withMessages(['message' => __('meeting.invalid_action_with_status', ['attribute' => trans('meeting.status.'. $this->getMeta('status'))])]);
        }
    }

    public function ensureIsScheduledOrLive() : void
    {
        if (! in_array($this->getMeta('status'), [MeetingStatus::SCHEDULED, MeetingStatus::LIVE])) {
            throw ValidationException::withMessages(['message' => __('meeting.invalid_action_with_status', ['attribute' => trans('meeting.status.'. $this->getMeta('status'))])]);
        }
    }

    public function ensureMemberCanJoin() : void
    {
        if (! $this->getMeta('accessible_to_members')) {
            return;
        }

        if (! \Auth::check()) {
            throw ValidationException::withMessages(['message' => __('membership.membership_expired')]);
        }

        $can_moderate = false;

        if ($this->user_id == \Auth::id() || \Auth::user()->hasRole('admin')) {
            $can_moderate = true;
        } else {
            $invitee = $this->getInvitee();
            $can_moderate = $invitee->getMeta('is_moderator') ? true : false;
        }

        if ($can_moderate) {
            return;
        }

        if (\Auth::user()->hasActiveMembership()) {
            return;
        }

        throw ValidationException::withMessages(['message' => __('membership.membership_expired')]);
    }

    public function ensureCommentable() : void
    {
        $this->isAccessible();

        $config = $this->getMeta('config') ? : [];

        if (! Arr::get($config, 'enable_comments')) {
            throw new UnauthorizedException();
        }

        if (! Arr::get($config, 'enable_comment_before_meeting_starts') && $this->getMeta('status') === MeetingStatus::SCHEDULED) {
            throw new UnauthorizedException();
        }

        $this->ensureIsScheduledOrLive();
    }

    public function isAccessible($editable = false) : bool
    {
        if (! $editable && $this->getMeta('is_pam')) {
            return true;
        }

        if (! $editable && $this->getMeta('accessible_via_link')) {
            return true;
        }

        if (\Auth::user()->id === $this->user_id || \Auth::user()->hasRole('admin')) {
            return true;
        }

        $invitee = $this->getInvitee();

        if ($invitee->getMeta('is_blocked')) {
            throw ValidationException::withMessages(['message' => trans('user.permission_denied')]);
        }

        if ($editable && ! $invitee->getMeta('is_moderator')) {
            throw ValidationException::withMessages(['message' => trans('user.permission_denied')]);
        }

        return true;
    }

    public function getInvitee() : ?Invitee
    {
        if (! $this->relationLoaded('invitees')) {
            $this->load(['invitees']);
        }

        $contact = \Auth::user()->contact;

        if (! $contact) {
            $contact = Contact::forceCreate([
                'email' => \Auth::user()->email,
                'user_id' => \Auth::id()
            ]);

            $contact->users()->syncWithoutDetaching([\Auth::id() => ['name' => \Auth::user()->name]]);

            // throw new UnauthorizedException();
        }

        $invitee = $this->invitees()->firstWhere('contact_id', $contact->id);

        if ($this->user_id == \Auth::id() && ! $invitee) {
            $invitee = Invitee::forceCreate([
                'meeting_id' => $this->id,
                'contact_id' => $contact->id
            ]);
        }

        if (! $invitee) {
            if ($this->getMeta('accessible_via_link')) {
                $invitee = Invitee::forceCreate([
                    'meeting_id' => $this->id,
                    'contact_id' => $contact->id
                ]);
            } else {
                throw new UnauthorizedException();
            }
        }

        return $invitee;
    }

    // Actions

    public function isCancellable() : self
    {
        if ($this->getMeta('status') != MeetingStatus::SCHEDULED) {
            return $this;
        }

        $date = Carbon::parse($this->start_date_time);

        if ($date->isFuture()) {
            return $this;
        }

        if ($date->diffInMinutes(now()) < 60) {
            return $this;
        }

        $meta = $this->meta;
        $meta['status'] = MeetingStatus::CANCELLED;
        $meta['cancellation_reason'] = 'auto';
        $meta['cancelled_at'] = now();
        $this->meta = $meta;
        $this->save();

        broadcast(new MeetingStatusChanged($this))->toOthers();

        return $this;
    }

    public function shouldEnd()
    {
        $status = $this->getMeta('status');

        if ($status == MeetingStatus::ENDED) {
            return;
        }

        if ($this->getMeta('keep_alive')) {
            return;
        }

        if (! $this->getMeta('estimated_end_time')) {
            return;
        }

        if (Carbon::parse($this->getMeta('estimated_end_time')) < now()) {
            $meta = $this->meta;
            $meta['status'] = MeetingStatus::ENDED;
            $this->meta = $meta;
            $this->save();
        }
    }

    public function cancel() : self
    {
        $meta = $this->meta;
        $meta['status'] = MeetingStatus::CANCELLED;
        $meta['cancellation_reason'] = request('cancellation_reason');
        $meta['cancelled_at'] = now();
        $this->meta = $meta;
        $this->save();

        broadcast(new MeetingStatusChanged($this))->toOthers();

        return $this;
    }

    public function cancelAutoEnd() : self
    {
        $meta = $this->meta;
        $config = $meta['config'] ?? [];
        $config['auto_end_meeting'] = request()->boolean('auto_end_meeting');
        $meta['config'] = $config;
        $meta['keep_alive'] = true;
        $this->meta = $meta;
        $this->save();

        broadcast(new MeetingStatusChanged($this))->toOthers();

        return $this;
    }

    public function snoozeEndTime() : self
    {
        if (! $this->getMeta('estimated_end_time')) {
            return $this;
        }

        $meta = $this->meta;
        $period = request('period');

        if ($this->period) {
            $meta['estimated_end_time'] = CalHelper::storeDateTime(Carbon::parse($meta['estimated_end_time'])->addMinutes($period));
        }

        $this->meta = $meta;
        $this->save();

        broadcast(new MeetingStatusChanged($this))->toOthers();

        return $this;
    }

    public function alert() : self
    {
        if(request('type') == 'MeetingRoomCreated') {
            if($this->getMeta('is_pam')) {
                broadcast(new PublicMeetingRoomCreated($this, json_decode(request('data'), true)))->toOthers();
            } else {
                broadcast(new MeetingRoomCreated($this, json_decode(request('data'), true)))->toOthers();
            }
        }

        return $this;
    }

    public function config() : self
    {
        $meta = $this->meta;
        $config = $meta['config'] ?? [];

        if ($this->getRTCLibrary() != request('rtc_library')) {
            $meta['room_id'] = $this->generateRoomId();
        }

        $config['rtc_library']                         = request('rtc_library');

        $config['can_toggle_audio']                    = request()->boolean('can_toggle_audio');
        $config['can_toggle_video']                    = request()->boolean('can_toggle_video');
        $config['can_share_files']                     = request()->boolean('can_share_files');
        $config['can_share_screen']                    = request()->boolean('can_share_screen');
        $config['can_share_link']                      = request()->boolean('can_share_link');
        $config['can_use_whiteboard']                  = request()->boolean('can_use_whiteboard');
        $config['can_use_hand_gesture']                = request()->boolean('can_use_hand_gesture');

        $config['enable_chat']                         = request()->boolean('enable_chat');
        $config['mute_participants_on_start']          = request()->boolean('mute_participants_on_start');
        $config['ask_host_before_joining']             = request()->boolean('ask_host_before_joining');
        $config['speech_detection']                    = request()->boolean('speech_detection');
        $config['enable_background_blur']              = request()->boolean('enable_background_blur');
        $config['layout']                              = request('layout');
        $config['max_participant_count']               = request('max_participant_count');

        $config['can_record']                          = request()->boolean('can_record');
        $config['enable_auto_recording']               = request()->boolean('enable_auto_recording');
        $config['auto_upload_recording']               = request()->boolean('auto_upload_recording');
        $config['auto_upload_recorded']                = request()->boolean('auto_upload_recorded');
        $config['can_stop_auto_recording']             = request()->boolean('can_stop_auto_recording');

        $config['can_take_snapshot']                   = request()->boolean('can_take_snapshot');
        $config['anyone_can_take_snapshot']            = request()->boolean('anyone_can_take_snapshot');
        $config['enable_snapshot_alert']               = request()->boolean('enable_snapshot_alert');
        $config['snapshot_alert_to_user_only']         = request()->boolean('snapshot_alert_to_user_only');
        $config['snapshot_alert_to_moderators']        = request()->boolean('snapshot_alert_to_moderators');

        $config['auto_end_meeting']                    = request()->boolean('auto_end_meeting');
        $config['alert_before_auto_end']               = request()->boolean('alert_before_auto_end');
        $config['can_snooze_auto_end']                 = request()->boolean('can_snooze_auto_end');
        $config['can_cancel_auto_end']                 = request()->boolean('can_cancel_auto_end');
        $config['alert_before_auto_end_time']          = request('alert_before_auto_end_time');

        $config['pam_open_join_as_guest_page']         = request()->boolean('pam_open_join_as_guest_page');
        $config['pam_can_share_screen_for_guest']      = request()->boolean('pam_can_share_screen_for_guest');
        $config['pam_can_share_link_for_guest']        = request()->boolean('pam_can_share_link_for_guest');
        $config['pam_can_use_whiteboard_for_guest']    = request()->boolean('pam_can_use_whiteboard_for_guest');

        $meta['config'] = $config;
        $this->meta = $meta;
        $this->save();

        return $this;
    }

    public function snooze() : self
    {
        $meta = $this->meta;
        $snoozed_logs = $meta['snoozed_logs'] ?? [];
        array_push($snoozed_logs, array(
            'start_date_time' => Carbon::parse($this->start_date_time)->toDateTimeString(),
            'period' => request('period')
        ));

        $meta['snoozed_logs'] = $snoozed_logs;

        if (Carbon::parse($this->start_date_time)->isFuture()) {
            $this->start_date_time = Carbon::parse($this->start_date_time)->addMinutes(request('period'));
        } else {
            $this->start_date_time = Carbon::parse(now())->addMinutes(request('period'));
        }

        if ($this->period) {
            $meta['estimated_end_time'] = CalHelper::storeDateTime(Carbon::parse($this->start_date_time)->addMinutes($this->period));
        }

        $this->meta = $meta;

        $this->save();

        broadcast(new MeetingStatusChanged($this))->toOthers();

        return $this;
    }

    public function live() : self
    {
        if ($this->getMeta('status') === MeetingStatus::LIVE) {
            return $this;
        }

        $meta = $this->meta;
        $meta['status'] = MeetingStatus::LIVE;
        $meta['room_id'] = $this->generateRoomId();
        $meta['started_at'] = now();

        $meta['estimated_end_time'] = CalHelper::storeDateTime(Carbon::parse($meta['started_at'])->addMinutes($this->period));

        $this->meta = $meta;
        $this->save();
        broadcast(new MeetingStatusChanged($this))->toOthers();

        if (! $this->getMeta('instant')) {
            $contact_ids = $this->invitees()->pluck('contact_id')->all();

            $users = User::select('id')->whereHas('contact', function($q) use($contact_ids) {
                $q->whereIn('id', $contact_ids);
            })->get();

            Notification::send($users, new MeetingIsLive($this));
        }

        return $this;
    }

    private function getRTCLibrary()
    {
        return in_array($this->getMeta('rtc_library'), ['rtcmc', 'janus']) ? $this->getMeta('rtc_library') : config('config.meeting.rtc_library', 'rtcmc');
    }

    private function generateRoomId()
    {
        $library = $this->getRTCLibrary();

        if ($library == 'rtcmc') {
            return Str::random(20);
        }

        return rand(10000000, 99999999);
    }

    public function end() : self
    {
        $meta = $this->meta;
        $meta['status'] = MeetingStatus::ENDED;
        $meta['ended_at'] = now();
        $this->meta = $meta;
        $this->save();
        broadcast(new MeetingStatusChanged($this))->toOthers();

        $contact_ids = $this->invitees()->pluck('contact_id')->all();

        $users = User::select('id')->whereHas('contact', function($q) use($contact_ids) {
            $q->whereIn('id', $contact_ids);
        })->get();

        Notification::send($users, new MeetingIsEnded($this));

        return $this;
    }

    public function logAdmin() : self
    {
        $meta = $this->meta;
        $meta['is_attendee'] = true;
        $logs = $meta['logs'] ?? [];
        array_push($logs, array(
            'start' => now(),
            'ip' => IpHelper::getClientIp()
        ));

        $meta['logs'] = $logs;
        $this->meta = $meta;
        $this->save();

        return $this;
    }

    // Filters

    public function scopeMyMeeting(Builder $query) : void
    {
        $query->where(function($q) {
            $q->whereUserId(\Auth::user()->id)
            ->orWhereHas('invitees', function($q1) {
                $q1->whereHas('contact', function($q2) {
                    $q2->whereUserId(\Auth::user()->id);
                });
            });
        });
    }

    public function scopeIsNotCancelled(Builder $query) : void
    {
        $query->where('meta->status', '!=', 'cancelled');
    }

    public function scopeIsScheduled(Builder $query) : void
    {
        $query->where('meta->status', '=', 'scheduled');
    }

    public function scopeattendedMeeting(Builder $query) : void
    {
        $query->where(function($q) {
            $q->where(function($q0) {
                $q0->whereUserId(\Auth::user()->id)->where('meta->is_attendee', \Auth::user()->id);
            })->orWhereHas('invitees', function($q1) {
                $q1->whereUserId(\Auth::user()->id)->where('is_attendee', 1);
            });
        });
    }

    public function scopeFilterByKeyword(Builder $query, $keyword = null) : void
    {
        $query->when($keyword, function ($q, $keyword) {
            return $q->where(function ($q1) use ($keyword) {
                $q1->where('title', 'like', '%'.$keyword.'%')->orWhere('agenda', 'like', '%'.$keyword.'%')->orWhere('description', 'like', '%'.$keyword.'%');
            });
        });
    }

    public function scopeDateBetween(Builder $query, $dates) : void
    {
        $start_date = Arr::get($dates, 'start_date');
        $end_date = Arr::get($dates, 'end_date') ? : $start_date;

        if ($start_date && $end_date && $start_date <= $end_date) {
            $query->where('start_date_time', '>=', CalHelper::startOfDate($start_date))->where('start_date_time', '<=', CalHelper::endOfDate($end_date));
        }
    }

    public function scopeFilterByName(Builder $query, $name = null) : void
    {
        $query->when($name, function ($q, $name) {
            return $q->where('name', 'like', '%'.$name.'%');
        });
    }
}
