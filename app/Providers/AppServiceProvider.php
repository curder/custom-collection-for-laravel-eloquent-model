<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Repositories\PostRepository;
use App\Models\Repositories\Contracts\PostRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
