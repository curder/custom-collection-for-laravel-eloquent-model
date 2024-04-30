<?php

namespace App\Models;

use App\Models\Builders\PostBuilder;
use App\Models\Collections\PostCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'body',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now()->toDateTimeString());
    }

    public function scopeOrderByMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }


    public function newCollection(array $models = [])
    {
        return PostCollection::make($models);
    }
}
