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
            'published_at' => null,
        ];
    }
}
