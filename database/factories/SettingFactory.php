<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>"arya olya",
            "email"=>"arya.olya9978@gmail.com",
            "phone_number"=>"09380524172",
            "github"=>"https://github.com/aryaOlya",
            "linkedin"=>"https://www.linkedin.com/in/arya-olya-774a67222/",
            "task"=>"billing app",
            "company"=>"vana"
        ];
    }
}
