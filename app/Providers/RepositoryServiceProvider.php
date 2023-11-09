<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\ChecklistContract;
use App\Contracts\TaskContract;
use App\Repositories\TaskRepository;
use App\Repositories\ChecklistRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(CategoryContract::class, CategoryRepository::class);
        $this->app->bind(ChecklistContract::class, ChecklistRepository::class);
        $this->app->bind(TaskContract::class, TaskRepository::class);
    }
}
