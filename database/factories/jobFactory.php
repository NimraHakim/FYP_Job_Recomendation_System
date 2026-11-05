<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\job>
 */
class jobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'title'=>fake()->name,
         'user_id'=>rand(1,2),
         'job_type_id'=>rand(1,5),
         'category_id'=>rand(1,5),
         'location'=>fake()->city,
         'vacancy'=>rand(1,5),
         'description'=>fake()->text,
         'experiance'=>rand(1,10),
         'company_name'=>fake()->name
        ];
    }
}
