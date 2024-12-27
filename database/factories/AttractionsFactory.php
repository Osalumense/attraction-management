<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attraction>
 */
class AttractionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'description' => $this->faker->text(),
            'location' => $this->faker->city(),
            'image_path' => $this->faker->imageUrl(640, 480, 'travel', true),
        ];
    }
}
