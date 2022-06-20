<?php

namespace App\Models;

use Clickadilla\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public const IN_PROCESSING_STATUS = 'in_processing';
    public const COMPLETED_STATUS = 'completed';
    public const CANCELED_STATUS = 'canceled';

    public const STATUSES = [
        self::IN_PROCESSING_STATUS,
        self::COMPLETED_STATUS,
        self::CANCELED_STATUS,
    ];

    public const DEFAULT_PRICING_PER = 1000;

    protected $attributes = [
        'status' => self::IN_PROCESSING_STATUS,
    ];

    protected $fillable = [
        'user_id',
        'quantity',
        'status',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'max_provider_price' => MoneyCast::class,
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function indicators(): OrderIndicators
    {
        return new OrderIndicators($this);
    }
}
