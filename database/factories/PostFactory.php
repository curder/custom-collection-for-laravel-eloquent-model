<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'body' => fake()->paragraph(6),
        ];
    }

    public function published(?Carbon $time = null): static
    {
        return $this->state(fn(array $attributes) => [
            'published_at' => $time ?? now(),
        ]);
    }

    public function unPublished(): static
    {
        return $this->state(fn(array $attributes) => [
            'published_at' => null,
        ]);
    }
}
