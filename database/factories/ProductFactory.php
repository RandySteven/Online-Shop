<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $factory->define(App\Product::class, function($faker))
        return [
            'name' => $this->faker->sentence(2),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'slug' => \Str::slug($this->faker->sentence(2)),
            'stock' => $this->faker->numberBetween(1, 500),
            'desc' => $this->faker->paragraph(3),
            'thumbnail' => 'images/product/'.$this->faker->image('public/storage/images/product', 640, 480, null, false),
            'category_id' => $this->faker->numberBetween(1, 7),
            'shop_id' => 2
        ];
    }
}
