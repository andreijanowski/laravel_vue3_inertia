<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $name = $this->faker->sentence(2);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomElement(['10.99', '20.99', '30.99', '40.99', '99.99']),
        ];
    }
}
