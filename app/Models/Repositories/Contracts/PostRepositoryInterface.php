<?php

namespace App\Models\Repositories\Contracts;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Collections\PostCollection;

interface PostRepositoryInterface
{
    public function getDropdownOptions($key = 'id', $value = 'name'): PostCollection;

    public function markAsPublished(int|array|PostCollection $id, ?Carbon $published_at = null): null|Post|PostCollection;
}
