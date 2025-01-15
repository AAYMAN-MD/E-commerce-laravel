<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_name = $this->faker->unique()->words($nb=2, $asText= true);
        $slug = str::slug($category_name);
        return [
            'name'=>str::title($category_name),
            'slug' => $slug,
            'image' => $this->faker->numberBetween(1,6).'.jpg'
        ];
    }
}
