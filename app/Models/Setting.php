<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;
    protected $fillable = ['key','value'];
    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;

    const DEFAULT_COLORS = [
        'primary_color' => '#2c3e50',
        'secondary_color' => '#e74c3c',
        'accent_color' => '#f39c12',
        'success_color' => '#27ae60',
        'light_bg' => '#f8f9fa',
        'dark_bg' => '#2c3e50',
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('site_colors'));
        static::deleted(fn() => Cache::forget('site_colors'));
    }

    public static function getValue(string $key, $default = null)
    {
        $row = static::query()->where('key',$key)->first();
        return $row ? $row->value : $default;
    }

    public static function putValue(string $key, $value): void
    {
        static::query()->updateOrCreate(['key'=>$key], ['value'=>$value]);
        Cache::forget('site_colors');
    }

    public static function colors(): array
    {
        return Cache::remember('site_colors', 3600, function(){
            $json = static::getValue('site_colors');
            $colors = [];
            if ($json) {
                $decoded = json_decode($json, true);
                if (is_array($decoded)) $colors = $decoded;
            }
            return array_merge(self::DEFAULT_COLORS, $colors);
        });
    }
}
