<?php

namespace App\Casts;

use Clickadilla\Money\ToMoneyManager;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Money\Money as MoneyPHP;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        if (isset($value)) {
            return app(ToMoneyManager::class)->intToMoney($value, $attributes[$key . '_currency'] ?? null);
        }

        return null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        if (isset($value)) {
            if (!(gettype($value) == 'object' && $value instanceof MoneyPHP)) {
                $value = str_to_money($value, $attributes[$key . '_currency'] ?? null);
            }

            return (int) $value->getAmount();
        }

        return null;
    }
}
