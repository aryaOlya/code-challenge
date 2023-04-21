<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brooker>
 */
class BrookerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>"kavenegar",
            "description"=>"sms panel",
            "unit_name"=>"character",
            "cost_per_unit"=>10
        ];
    }
}
