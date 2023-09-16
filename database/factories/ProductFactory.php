<?php

declare(strict_types=1);

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
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'title' => $this->faker->words(rand(2, 4), true),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 100, 500),
            'category_id' => $this->faker->randomElement(['dba28765-8e72-4a36-95b0-df2265061507', 'e42d89bd-bf17-492f-a558-5abccafaa1a5', 'ff5ea337-3216-403e-b8a1-9375cf0e4211']),
        ];
    }
}
