<?php

namespace App\Models;

use App\Traits\HasMeta;
use App\Traits\HasUuid;
use App\Traits\ModelOption;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Option extends Model
{
    use HasUuid, HasMeta, ModelOption, LogsActivity;

    protected $guarded = [];
    protected $casts = [
        'meta' => 'array',
    ];
    protected $table = 'options';
    protected static $logName = 'option';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $sortOptions = ['created_at', 'name', 'updated_at'];
    protected static $defaultSortBy = 'name';

    // Booted
    public static function booted()
    {
    }

    protected static function ensureUpdatable() : void
    {
        // if ($this->completed_at) {
        //  throw CouldNotUpdate::isCompleted($this);
        // }
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

    public function scopeFilterByType(Builder $query, $type = null) : void
    {
        $query->when($type, function ($q, $type) {
            return $q->where('type', '=', $type);
        });
    }

    public function scopeFilterBySlug(Builder $query, $slug = null) : void
    {
        $query->when($slug, function ($q, $slug) {
            return $q->where('slug', '=', $slug);
        });
    }

    public function scopeFilterByName(Builder $query, $name = null) : void
    {
        $query->when($name, function ($q, $name) {
            return $q->where('name', 'like', '%'.$name.'%');
        });
    }
}
