<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = collect(['BCA', 'Go-Pay', 'OVO']);
        $payments->each(function($c){
            Payment::create([
                'payment' => $c
            ]);
        });
    }
}
