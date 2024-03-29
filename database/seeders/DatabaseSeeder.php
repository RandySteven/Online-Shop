<?php

namespace Database\Seeders;

use App\Models\Courier;
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
        // $this->call(RoleSeeder::class);
        // \App\Models\User::factory(10)->create();
        // $this->call(CategorySeeder::class);
        // $this->call(CourierSeeder::class);
        \App\Models\Product::factory(10)->create();
        // $this->call(PaymentSeeder::class);
    }
}
