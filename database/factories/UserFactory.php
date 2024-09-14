<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeChildren;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'=>Customer::all()->random()->email | Employee::all()->random()->email | EmployeeChildren::all()->random()->email,
            'password' =>Customer::all()->random()->password | Employee::all()->random()->password | EmployeeChildren::all()->random()->password,
            'role'=>Customer::all()->random()->role | Employee::all()->random()->role | EmployeeChildren::all()->random()->role,
            'tokenable_id'=>Customer::all()->random()->id | Employee::all()->random()->id | EmployeeChildren::all()->random()->id,
            'tokenable_type'=>Customer::all()->random()->type | Employee::all()->random()->type | EmployeeChildren::all()->random()->type,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
