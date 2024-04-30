<?php

namespace App\Models\Repositories;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Collections\PostCollection;
use App\Models\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getDropdownOptions($key = 'id', $value = 'name'): PostCollection
    {
        /** @var PostCollection $posts */
        $posts = Post::query()
            ->published()
            ->orderByMostRecent()
            ->get();

        return $posts->toDropdown($key, $value);
    }

    public function markAsPublished(int|array|PostCollection $id, ?Carbon $published_at = null): null|Post|PostCollection
    {
        $published_at = $published_at ?? now();

        return match (true) {
            is_int($id) => Post::query()->find($id)?->markAsPublished($published_at),

            $id instanceof PostCollection => $id->markAsPublished($published_at),

            is_array($id) => Post::query()->whereIn('id', $id)->get()->markAsPublished($published_at),
        };
    }
}
