<?php

namespace App\Models\Config;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Config extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'value'];
    protected static $logName = 'config';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = ['updated_at'];

    const ASSET_TYPES = [
        'logo',
        'logo_light',
        'icon',
        'favicon',
        'icon_maskable',
        "icon_512",
        "icon_192",
        "icon_180",
        "icon_32",
        "icon_16",
        'screenshot_web_1',
        'screenshot_web_2',
        'screenshot_web_2',
        'screenshot_mobile_1',
        'screenshot_mobile_2',
        'screenshot_mobile_3',
    ];

    protected $casts = [
        'value' => 'json',
        'meta'  => 'json'
    ];

    public function getValue(string $option)
    {
        return Arr::get($this->value, $option);
    }
}
