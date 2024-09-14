<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ContactType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactBranch>
 */
class ContactBranchFactory extends Factory
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
                'branch_id' => Branch::all()->random()->id,
                'contact_type_id' =>ContactType::all()->random()->id,
        ];
    }
}
