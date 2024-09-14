<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */protected static ?string $password;
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->date(),
            'role' => fake()->randomElement(['guest']),
            'age' => fake()->randomNumber(2),
            'customer_image' => fake()->randomElement([
                '6 (1).jpg',
                '6 (2).jpg',
                '6 (3).jpg',
                '6 (4).jpg',
                '6 (5).jpg',
                '6 (6).jpg',
                '6 (7).jpg',
            ]),
            "email"=>fake()->unique()->email(),
            'password'=> static::$password ??= Hash::make('password'),
            'country_id' => Country::all()->random()->id,
        ];
    }
}
