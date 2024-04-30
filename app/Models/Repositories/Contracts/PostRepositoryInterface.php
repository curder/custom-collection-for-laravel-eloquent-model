<?php

namespace App\Models\Repositories\Contracts;

use App\Models\Collections\PostCollection;

interface PostRepositoryInterface
{
    public function getDropdownOptions($key = 'id', $value = 'name'): PostCollection;
}