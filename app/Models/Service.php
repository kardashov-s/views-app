<?php

namespace App\Models;

use Clickadilla\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    public const IN_STREAM_AD_TYPE = 'in_stream_ad';
    public const VIDEO_DISCOVERY_AD_TYPE = 'video_discovery_ad';

    public const TYPES = [
        self::IN_STREAM_AD_TYPE,
        self::VIDEO_DISCOVERY_AD_TYPE,
    ];

    protected $fillable = [
        'price',
        'name',
        'is_enabled',
        'type',
        'min_provider_price',
        'max_provider_price',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'is_enabled' => 'bool',
        'min_provider_price' => MoneyCast::class,
        'max_provider_price' => MoneyCast::class,
    ];

    protected $attributes = [
        'is_enabled' => true,
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
