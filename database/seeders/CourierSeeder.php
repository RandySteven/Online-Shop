<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Courier::create([
            'courier' => 'JNE',
            'price' => 12000,
            'duration' => '2-3 hari'
        ]);

        Courier::create([
            'courier' => 'TIKI',
            'price' => 10000,
            'duration' => '3-6 hari',
        ]);

        Courier::create([
            'courier' => 'JRE',
            'price' => 12000,
            'duration' => '1-2 hari'
        ]);
    }
}
