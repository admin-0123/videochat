<?php

namespace App\Models;

use App\Models\User;
use App\Traits\HasMeta;
use App\Traits\HasUuid;
use App\Traits\ModelOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Membership extends Model
{
    use HasUuid, HasMeta, ModelOption, LogsActivity;

    protected $guarded = [];
    protected $casts = [
        'meta' => 'array',
        'start_date' => 'date',
        'expiry_date' => 'date',
        'billing_address' => 'array',
        'payment_gateway' => 'array'
    ];
    protected $table = 'memberships';
    protected static $logName = 'membership';
    protected static $logFillable = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = [ 'updated_at'];
    protected static $sortOptions = ['created_at', 'updated_at'];
    protected static $defaultSortBy = 'created_at';

    // Relations
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Booted
    public static function booted()
    {
    }

    protected static function ensureUpdatable() : void
    {
    }

    // Scope
    public function scopeInfo(Builder $q)
    {
        return $q->with('user');
    }

    // Filters

    public function scopeFilterById(Builder $query, $id = null) : void
    {
        $query->when($id, function ($q, $id) {
            return $q->where('id', '=', $id);
        });
    }
}
