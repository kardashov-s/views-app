<?php

namespace App;

use Money\Money;

class MoneyHelper
{
    private array $currencyData;
    private Money $money;

    public function __construct(array $currencyData)
    {
        $this->currencyData = $currencyData;
    }

    public function setMoney(Money $money)
    {
        $this->money = $money;

        return $this;
    }

    public function incrementPenny(): Money
    {
        return $this->money->add(str_to_money($this->getCurrencyValue('increment'), $this->money->getCurrency()));
    }

    public function round(int $roundingMode = Money::ROUND_UP): Money
    {
        $precisionRate = pow(10, $this->getCurrencyValue('minorUnit') - $this->getCurrencyValue('precision'));

        return $this->money->divide($precisionRate, $roundingMode)->multiply($precisionRate);
    }

    public function toDecimalStr()
    {
        return round(money_to_decimal_str($this->round()), $this->getCurrencyValue('precision'));
    }

    public function getMinBudget()
    {
        return str_to_money($this->getCurrencyValue('min_budget'), $this->money->getCurrency());
    }

    private function getCurrencyValue(string $key)
    {
        return $this->currencyData[$this->money->getCurrency()->getCode()][$key];
    }
}
