<?php

namespace App\Models;

use App\Traits\HasMeta;
use App\Traits\HasUuid;
use App\Traits\ModelOption;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use HasUuid, HasMeta, ModelOption, LogsActivity;

    protected $guarded = [];
    protected $casts = [
        'meta' => 'array',
        'start_date' => 'date',
        'billing_address' => 'array',
        'payment_gateway' => 'array'
    ];
    protected $table = 'transactions';
    protected static $logName = 'transaction';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $sortOptions = ['created_at', 'updated_at'];
    protected static $defaultSortBy = 'created_at';

    // Relations
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
    }

    // Booted
    public static function booted()
    {
    }

    protected static function ensureUpdatable() : void
    {
        //
    }

    // Filters
    public function scopeFilterById(Builder $query, $id) : void
    {
        $query->when($id, function ($q, $id) {
            return $q->where('id', '=', $id);
        });
    }

    public function scopeFilterByUuid(Builder $query, $uuid) : void
    {
        $query->when($uuid, function ($q, $uuid) {
            return $q->where('uuid', '=', $uuid);
        });
    }
}
