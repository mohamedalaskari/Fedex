<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeChildren>
 */
class EmployeeChildrenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */ protected static ?string $password;
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'employee_id' => Employee::all()->random()->id, 
            'birth_date' => fake()->date(),
            'role' => fake()->randomElement(['employee_children']),
            'age' => fake()->randomNumber(2), 
            'employee_childern_image' => fake()->randomElement([
                '6 (1).jpg',
                '6 (2).jpg',
                '6 (3).jpg',
                '6 (4).jpg',
                '6 (5).jpg',
                '6 (6).jpg',
                '6 (7).jpg',
            ]),
            "email"=>fake()->unique()->email(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
