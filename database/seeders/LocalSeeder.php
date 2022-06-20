<?php

namespace Database\Seeders;

use App\Models\GoogleAds\GoogleAdsAccount;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'vast-service',
            'api_token' => 1234,
            'password' => Hash::make('secret'),
        ]);
    }
}
