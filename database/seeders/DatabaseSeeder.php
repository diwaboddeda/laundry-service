<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class, // Remains the same
            ServiceSeeder::class, // Renamed from LayananSeeder to ServiceSeeder
            TransactionSeeder::class, // Renamed from TransaksiSeeder to TransactionSeeder
        ]);
    }
}
