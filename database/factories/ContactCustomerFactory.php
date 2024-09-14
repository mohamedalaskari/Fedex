<?php

namespace Database\Factories;

use App\Models\ContactType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactCustomer>
 */
class ContactCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'contact' => fake()->unique()->e164PhoneNumber(),
            'customer_id' => Customer::all()->random()->id,
            'contact_type_id' => ContactType::all()->random()->id, 
        ];
    }
}
