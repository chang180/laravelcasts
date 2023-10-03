<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paddle_product_id' => $this->faker->uuid,
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image_name' => 'image.png',
            'learnings' => [
                $this->faker->sentence,
                $this->faker->sentence,
                $this->faker->sentence,
            ],
            'tagline' => $this->faker->sentence,
        ];
    }

    public function released(Carbon $date = null): self
    {
        return $this->state(
            fn ($attributes) => [
                'released_at' => $date ?? Carbon::now(),
            ],
        );
    }
}
