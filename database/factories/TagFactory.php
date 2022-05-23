<?php

namespace Database\Factories;

use App\Models\TagCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tag_category_id' => TagCategory::factory(),
            'slug' => $this->faker->slug(),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->image("storage/app/public/images/tags", 480, 640, null, false),
        ];
    }
}
