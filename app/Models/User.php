<?php

namespace App\Models;

use App\Enums\Auth\UserStatus;
use App\Events\UserLogin;
use App\Traits\HasMeta;
use App\Traits\HasUuid;
use App\Models\Contact;
use App\Traits\ModelOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasMeta, HasUuid, ModelOption, LogsActivity, HasApiTokens, HasRoles, HasFactory, Notifiable, HasPushSubscriptions;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'      => 'datetime',
        'membership_expiry_date' => 'date',
        'preference'             => 'array',
        'meta'                   => 'array'
    ];

    protected static $logName = 'user';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = ['updated_at'];

    protected static $sortOptions = ['created_at', 'name', 'email', 'username', 'status', 'updated_at'];
    protected static $defaultSortBy = 'name';

    // Relations
    public function contact() : HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function contacts() : BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'contact_user', 'user_id', 'contact_id');
    }

    public function segments() : BelongsToMany
    {
        return $this->belongsToMany(Segment::class, 'segment_user', 'user_id', 'segment_id');
    }

    public function memberships() : HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function getPreference(string $option)
    {
        return Arr::get($this->preference, $option);
    }

    public function getTimezoneAttribute()
    {
        return Arr::get($this->preference, 'system.timezone', config('config.system.timezone'));
    }

    public function getIsPremiumAttribute()
    {
        return $this->getMeta('is_premium') ? true : false;
    }

    public function getUserPreferenceAttribute()
    {
        return array(
            'system' => array(
                'locale'      => Arr::get($this->preference, 'system.locale', config('config.system.locale')),
                'timezone'    => $this->timezone,
                'date_format' => Arr::get($this->preference, 'system.date_format', config('config.system.date_format')),
                'time_format' => Arr::get($this->preference, 'system.time_format', config('config.system.time_format')),
            ),
            'chat' => array(
                'enable_auto_open'        => (bool) Arr::get($this->preference, 'chat.enable_auto_open', config('config.chat.enable_auto_open')),
                'enter_to_submit'         => (bool) Arr::get($this->preference, 'chat.enter_to_submit', config('config.chat.enter_to_submit')),
                'mute_sound_notification' => (bool) Arr::get($this->preference, 'chat.mute_sound_notification', config('config.chat.mute_sound_notification')),
            )
        );
    }

    public function hasActiveMembership()
    {
        if ($this->hasRole('admin')) {
            return true;
        }

        if ($this->getMeta('lifetime')) {
            return true;
        }

        if ($this->is_premium) {
            return true;
        }

        $membership_expiry_date = $this->membership_expiry_date;

        if (! $membership_expiry_date) {
            return false;
        }

        if ($membership_expiry_date < today()) {
            return false;
        }

        return true;
    }

    // Constrains

    public function validateStatus($auth_event = true) : void
    {
        if (! $this->can('enable-login')) {
            $this->logout();
            throw ValidationException::withMessages(['message' => __('auth.login.login_permission_disabled')]);
        }

        if ($this->status != UserStatus::ACTIVATED) {
            $this->logout();
            throw ValidationException::withMessages(['message' => __('auth.login.status.' . $this->status)]);
        }

        if (config('config.system.maintenance_mode') && ! \Auth::user()->hasRole('admin')) {
            $this->logout();
            throw ValidationException::withMessages(['message' => config('config.system.maintenance_mode_message')]);
        }

        if ($auth_event) {
            event(new UserLogin($this));
        }
    }

    public function logout() : void
    {
        \Auth::guard('web')->logout();
    }

    public function getRole() : string
    {
        return Arr::first(\Auth::user()->getRoleNames());
    }

    // Filters

    public function scopeSearch(Builder $query, $search = null)
    {
        $fuzzy = implode("%", str_split($search));
        $fuzzy = "%$fuzzy%";

        $query->when($search, function ($q) use ($fuzzy) {
            return $q->where(function($q1) use ($fuzzy) {
                $q1->where('name', 'like', $fuzzy)
                ->orWhere('email', 'like', $fuzzy)
                ->orWhere('username', 'like', $fuzzy);
            });
        });
    }

    public function scopeFilterByKeyword(Builder $query, $keyword = null) : void
    {
        $query->when($keyword, function ($q, $keyword) {
            return $q->where(function ($q1) use ($keyword) {
                $q1->where('name', 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%')->orWhere('username', 'like', '%'.$keyword.'%');
            });
        });
    }

    public function scopeFilterByEmail($q, $email = null, $s = 0)
    {
        if (! $email) {
            return $q;
        }

        return ($s) ? $q->where('email', '=', $email) : $q->where('email', 'like', '%'.$email.'%');
    }

    public function scopeFilterByUsername($q, $username = null, $s = 0)
    {
        if (! $username) {
            return $q;
        }

        return ($s) ? $q->where('username', '=', $username) : $q->where('username', 'like', '%'.$username.'%');
    }

    public function scopeFilterByName($q, $name = null, $s = 0)
    {
        if (! $name) {
            return $q;
        }

        return ($s) ? $q->where('name', '=', $name) : $q->where('name', 'like', '%'.$name.'%');
    }

    public function scopeDateBetween(Builder $query, $dates) : void
    {
        $start_date = Arr::get($dates, 'start_date');
        $end_date = Arr::get($dates, 'end_date') ? : $start_date;

        if ($start_date && $end_date && $start_date <= $end_date) {
            $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        }
    }
}
