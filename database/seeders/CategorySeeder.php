<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            'Kamera', 'Baju Pria', 'Baju Wanita', 'Baju Anak', 'Elektronik', 'Wedding', 'Toys and Hobbies'
        ]);
        $categories->each(function($c){
            Category::create([
                'category' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
