<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->randomElement([
                'United States',
                'Canada',
                'Mexico',
                
                
                'Brazil',
                'Argentina',
                'Colombia',
                
                
                'United Kingdom',
                'Germany',
                'France',
                
                'Nigeria',
                'South Africa',
                'Egypt',
                
                            ]),
        ];
    }
}
