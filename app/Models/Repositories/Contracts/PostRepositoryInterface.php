<?php

namespace App\Models\Repositories\Contracts;

use App\Models\Collections\PostCollection;
use App\Models\Post;
use Carbon\Carbon;

interface PostRepositoryInterface
{
    public function getDropdownOptions($key = 'id', $value = 'name'): PostCollection;
    public function markAsPublished(int|array|PostCollection $id, Carbon $published_at = null): null|Post|PostCollection;
}