<?php

namespace Database\Factories;

use App\Models\ProductLine;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_image' => fake()->randomElement([
                '6 (1).jpg',
                '6 (2).jpg',
                '6 (3).jpg',
                '6 (4).jpg',
                '6 (5).jpg',
                '6 (6).jpg',
                '6 (7).jpg',
            ]),
            'product_name' => fake()->name(),
            'product_price' => fake()->randomFloat(2),
            'quntity_stock' => fake()->randomNumber(2),
            'product_line_id' => ProductLine::all()->random()->id,
        ];
    }
}
