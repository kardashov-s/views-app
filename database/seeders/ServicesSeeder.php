<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    private const SERVICES = [
        [
            'name' => 'WW Adwords',
            'price' => 1.5,
            'max_provider_price' => 1.3,
            'min_provider_price' => 1,
            'is_enabled' => true,
            'min_quantity' => 1000,
            'max_quantity' => 10000,
        ],
        [
            'name' => 'GEO Adwords',
            'price' => 2.8,
            'max_provider_price' => 2.3,
            'min_provider_price' => 1,
            'is_enabled' => true,
            'min_quantity' => 1000,
            'max_quantity' => 10000,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::SERVICES as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                [
                    'name' => $service['name'],
                    'price' => $service['price'],
                    'max_provider_price' => $service['max_provider_price'],
                    'min_provider_price' => $service['min_provider_price'],
                    'is_enabled' => $service['is_enabled'],
                    'min_quantity' => $service['min_quantity'],
                    'max_quantity' => $service['max_quantity'],
                ],
            );
        }
    }
}
