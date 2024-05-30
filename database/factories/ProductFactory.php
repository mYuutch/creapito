<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(10, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image_url' => 'products/test.webp',
            'type_id' => $this->faker->numberBetween(1, 10),
            'theme_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
