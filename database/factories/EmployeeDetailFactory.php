<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeDetail>
 */
class EmployeeDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
           // 'employee_id' => optional(Employee::inRandomOrder()->first())->id,

        'designation' => $this->faker->jobTitle,
        'salary' => $this->faker->randomFloat(2, 20000, 80000),
        'address' => $this->faker->address,
        'joined_date' => $this->faker->date(),
        ];
    }
}
