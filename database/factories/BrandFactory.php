<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brand_name = $this->faker->unique()->words($nb=2, $asText= true);
        $slug = str::slug($brand_name);
        return [
            'name'=>str::title($brand_name),
            'slug' => $slug,
            'image' => $this->faker->numberBetween(1,6).'.jpg'
        ];
    }
}
