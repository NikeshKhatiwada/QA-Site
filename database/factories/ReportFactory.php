<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\ReportCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'report_category_id' => ReportCategory::factory(),
            'report_about_id' => Question::factory(),
            'report_about_category' => 1,
            'report_description' => $this->faker->paragraph(),
        ];
    }
}
