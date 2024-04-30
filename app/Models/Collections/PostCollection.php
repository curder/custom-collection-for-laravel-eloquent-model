<?php

namespace App\Models\Collections;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostCollection extends Collection
{
    public function toDropdown(string $key = 'id', string $value = 'name'): static
    {
        return $this->keyBy($key)
            ->map(
                fn (Post $post) => $post->getAttribute($value)
            );
    }

    public function markAsPublished(Carbon $published_at): self
    {
        $this->each(
            fn (Post $post) => $post->markAsPublished($published_at)
        );

        return $this;
    }
}
