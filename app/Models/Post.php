<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Collections\PostCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function markAsPublished(Carbon $published_at): self
    {
        $this->update(['published_at' => $published_at]);

        return $this;
    }

    public function newCollection(array $models = [])
    {
        return PostCollection::make($models);
    }
}
