<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Money\Money;

abstract class Resource extends JsonResource
{
    protected function formatDecimalMoney($value, $accuracy = 4): ?float
    {
        return $value instanceof Money ? money_to_decimal_str($value, $accuracy) : null;
    }
}
