<?php

namespace App\Models\Repositories;

use App\Models\Collections\PostCollection;
use App\Models\Post;
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
}