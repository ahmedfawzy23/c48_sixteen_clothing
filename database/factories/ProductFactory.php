<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::all()->random()->id,
            'title' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(50),
            'price' => $this->faker->randomFloat(2, 1000, 3000),
            'stock' => $this->faker->numberBetween(100, 500),
            'is_active' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl(600, 400, 'products'),
        ];
    }
}
