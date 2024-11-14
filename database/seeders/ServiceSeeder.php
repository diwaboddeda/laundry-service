<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adding services with English names and values
        Service::create([
            'name' => 'regular',   // 'reguler' renamed to 'regular'
            'duration' => 48,      // 'durasi' renamed to 'duration'
            'price' => 8000        // 'harga' renamed to 'price'
        ]);

        Service::create([
            'name' => 'fast',      // 'kilat' renamed to 'fast'
            'duration' => 24,
            'price' => 10000
        ]);

        Service::create([
            'name' => 'express',
            'duration' => 12,
            'price' => 15000
        ]);

        Service::create([
            'name' => 'exclusive',
            'duration' => 6,
            'price' => 30000
        ]);
    }
}
