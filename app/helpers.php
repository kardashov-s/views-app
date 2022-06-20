<?php

use Money\Money;

if (!function_exists('money_to_default_currency')) {
    function money_to_default_currency(Money $money): Money
    {
        return convert_money($money, config('money.default_currency'));
    }
}
