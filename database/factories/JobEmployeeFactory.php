<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JopEmployee>
 */
class JobEmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => fake()->randomElement([
                'Customer Service Representative',
                'Technical Support Specialist',
                'Client Relations Manager',
                'Call Center Supervisor',                
                'Sales Representative',
                'Marketing Coordinator',
                'Digital Marketing Specialist',
                'Account Manager',
                
                
                'HR Generalist',
                'HR Coordinator',
                'Talent Acquisition Specialist',
                'Training and Development Manager',
                'Finance and Accounting Roles:',
                
                'Accountant',
                'Financial Controller',
                'Payroll Specialist',
                'Accounts Payable Clerk'
            ]),
        ];
    }
}
