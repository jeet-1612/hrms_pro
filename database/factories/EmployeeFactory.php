<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'employee_code' => 'EMP' . $this->faker->unique()->numberBetween(10000,99999),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-20 years'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['single', 'married']),
            'personal_email' => $this->faker->unique()->safeEmail(),
            'personal_phone' => $this->faker->phoneNumber(),
            'current_address' => $this->faker->address(),
            'joining_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'employment_type' => $this->faker->randomElement(['permanent', 'contract']),
            'employment_status' => 'active',
            'basic_salary' => $this->faker->numberBetween(20000, 100000),
            'gross_salary' => $this->faker->numberBetween(25000, 120000),
        ];
    }
}
