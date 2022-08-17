<?php

namespace App\Http\Resources;

use App\Enums\MeetingStatus;
use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Helpers\SysHelper;
use App\Http\Resources\MediaCollection;
use App\Http\Resources\Option;
use App\Http\Resources\User;
use App\Traits\MeetingConfig;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class Meeting extends JsonResource
{
    use MeetingConfig;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type = ArrHelper::searchByKey(ArrHelper::getTransList('types', 'meeting'), 'uuid', $this->type);

        $status = $this->getMeta('status');
        $config = $this->getMeta('config');

        $this->shouldEnd();

        $can_moderate = false;
        $is_blocked = true;
        $is_host = $this->user_id == \Auth::id() ? true : false;

        if ($this->getMeta('is_pam') && ! \Auth::check()) {
            $is_blocked = false;
        } else if ($this->user_id == \Auth::id() || \Auth::user()->hasRole('admin')) {
            $can_moderate = true;
            $is_blocked = false;
        } else {
            $invitee = $this->getInvitee();
            $is_blocked = $invitee->getMeta('is_blocked') ? true : false;
            $can_moderate = $invitee->getMeta('is_moderator') ? true : false;
        }

        $config = $this->getMeetingConfig($config);

        return [
           'uuid'                    => $this->uuid,
           'title'                   => $this->title,
           'is_host'                 => $is_host,
           'is_instant_meeting'      => $this->getMeta('instant'),
           'accessible_via_link'     => $this->getMeta('accessible_via_link'),
           'is_pam'                  => $this->getMeta('is_pam'),
           'is_paid'                 => $this->is_paid,
           'fee'                     => $this->when($this->is_paid, SysHelper::formatCurrency($this->getFee('amount'))),
           'has_paid'                => $this->when($this->is_paid, $this->has_paid),
           'identifier'              => $this->getMeta('identifier'),
           'keep_alive'              => $this->getMeta('keep_alive'),
           'event_uuid'              => $this->getMeta('event_uuid'),
           'has_event'               => (bool) $this->getMeta('has_event'),
           'agenda'                  => $this->agenda,
           'cover'                   => $this->getMeta('cover_image'),
           'type'                    => $type,
           'category'                => new Option($this->whenLoaded('category')),
           'description'             => $this->description,
           'start_date_time'         => CalHelper::toDateTime($this->start_date_time),
           'period'                  => $this->period,
           'attachments'             => new MediaCollection($this->getMedia()),
           'planned_start_date_time' => CalHelper::toDateTime($this->planned_start_date_time),
           'status'                  => $status,
           'has_snapshots'           => count($this->getMedia('snapshots')) ? true : false,
           'has_recordings'          => count($this->getMedia('recordings')) ? true : false,
           'has_chunk_recordings'    => count($this->getMeta('chunk_recordings') ?? []) ? true : false,
           'config'                  => $config,
           'max_participant_count'   => (int) Arr::get($config, 'max_participant_count'),
           'accessible_to_members' => (bool) $this->getMeta('accessible_to_members'),
           'delayed'               => $this->getMeta('snooze_logs') ? true : false,
           'cancellation_reason'   => $this->getMeta('cancellation_reason') ? : null,
           'room_id'               => $this->when($status === 'live', $this->getMeta('room_id')),
           'started_at'            => CalHelper::toDateTime($this->getMeta('started_at')),
           'ended_at'              => CalHelper::toDateTime($this->getMeta('ended_at')),
           'estimated_end_time'    => CalHelper::toDateTime($this->getMeta('estimated_end_time')),
           'user'                  => $this->when(\Auth::check(), new User($this->whenLoaded('user'))),
           'can_moderate'          => $can_moderate,
           'is_blocked'            => $is_blocked,
           'created_at'            => CalHelper::toDateTime($this->created_at),
           'updated_at'            => CalHelper::toDateTime($this->updated_at)
        ];
    }
}
