<?php

namespace App\Models\Config;

use App\Traits\ModelOption;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use ModelOption;

    protected $fillable = ['name'];
    protected $primaryKey = 'id';
    protected $table = 'permissions';
    protected static $sortOptions = ['created_at', 'name', 'updated_at'];
    protected static $defaultSortBy = 'name';

    public function scopeFilterByUuid($q, $uuid = null)
    {
        if (! $uuid) {
            return $q;
        }

        return $q->where('uuid', '=', $uuid);
    }

    public function scopeFilterByName($q, $name = null)
    {
        if (! $name) {
            return $q;
        }

        return $q->where('name', 'like', '%' . $name . '%');
    }
}
