<?php

namespace App\Models\Collections;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PostCollection extends Collection
{
    public function toDropdown(string $key = 'id', string $value = 'name'): static
    {
        return $this->keyBy($key)
            ->map(
                fn(Post $post) => $post->getAttribute($value)
            );
    }
}