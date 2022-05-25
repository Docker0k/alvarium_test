<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hourly = $this->faker->boolean;

        return [
            'department_id' => function(){
                return Department::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->name(),
            'birthday' => $this->faker->date('Y-m-d', '2000-01-01'),
            'job' => $this->faker->jobTitle(),
            'hourly' => $hourly,
            'salary' => $this->faker->randomFloat(2, 100, 1000),
            'hours' => $hourly ? $this->faker->randomFloat(0, 1, 140) : 0,
        ];
    }
}
