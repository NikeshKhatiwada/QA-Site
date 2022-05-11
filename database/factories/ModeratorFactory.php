<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Moderator>
 */
class ModeratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'first_name' => $this->faker->firstNameMale(),
            'last_name' => $this->faker->lastName(),
            'password' => $this->faker->password(10, 18),
            'remember_token' => Str::random(10),
        ];
    }
}
