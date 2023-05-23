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
            'Kaca',
            'Lem',
            'Karet Seal',
            'Kunci',
            'Handle Pintu',
            'Roda Etalase',
            'Aluminium',
            'Paku Rivet dan Baut',
            'Engsel Pintu',
            'Glass Cutter',
            'Stiker Kaca',
            'Hand Riveter',
            'Bor',
            'Gerinda'
        ]);
        $categories->each(function($c){
            Category::create([
                'category' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
