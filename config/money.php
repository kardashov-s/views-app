<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default currency of Money instance
    |--------------------------------------------------------------------------
    |
    | One of USD, RUB
    |
    */
    'default_currency' => env('DEFAULT_CURRENCY', 'USD'),

    'currencies' => [

        'USD' => [
            'currency' => 'US Dollar',
            'minorUnit' => 4,
            'symbol' => '$',
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 0.7,
        ],

        'RUB' => [
            'currency' => 'Ruble',
            'minorUnit' => 4,
            'symbol' => "\u{20BD}",
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 50,
        ],

        'GBP' => [
            'currency' => 'Pound sterling',
            'minorUnit' => 4,
            'symbol' => "\u{00A3}",
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 0.5,
        ],

        'EUR' => [
            'currency' => 'EURO',
            'minorUnit' => 4,
            'symbol' => "€",
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 0.6,
        ],

        'INR' => [
            'currency' => 'Indian Rupee',
            'minorUnit' => 4,
            'symbol' => "₹",
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 50,
        ],

        'UAH' => [
            'currency' => 'Ukrainian hryvnia',
            'minorUnit' => 4,
            'symbol' => "грн",
            'increment' => 0.01,
            'precision' => 2,
            'min_budget' => 12,
        ],

        'VND' => [
            'currency' => 'Vietnamese dong',
            'minorUnit' => 4,
            'symbol' => "₫",
            'increment' => 1,
            'precision' => 0,
            'min_budget' => 16000,
        ],

    ],

];
