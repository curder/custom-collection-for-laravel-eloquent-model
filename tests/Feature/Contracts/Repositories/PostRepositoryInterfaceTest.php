<?php

use App\Models\Collections\PostCollection;
use App\Models\Post;
use App\Models\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('has get dropdown options method', function () {
    $repository = app(PostRepositoryInterface::class);

    $post = Post::factory()->published()->create();

    expect($repository->getDropdownOptions())
        ->toBeInstanceOf(PostCollection::class)
        ->toMatchArray([$post->id => $post->name,])
        ->and($repository->getDropdownOptions(value: 'description'))
        ->toMatchArray([$post->id => $post->description,]);
});


it('only can get dropdown options for published posts', function () {
    $repository = app(PostRepositoryInterface::class);

    Post::factory()->unPublished()->create();
    Post::factory()->published(now()->addMinute())->create();

    expect($repository->getDropdownOptions())
        ->toBeInstanceOf(PostCollection::class)
        ->toHaveCount(0);
});

it('has order by most recent dropdown options', function () {
    $repository = app(PostRepositoryInterface::class);

    $first = Post::factory()->published(now())->create();
    $second = Post::factory()->published(now()->subMinute())->create();

    expect($repository->getDropdownOptions())
        ->toHaveCount(2)
        ->toMatchArray([
            $first->id => $first->name,
            $second->id => $second->name,
        ]);
});