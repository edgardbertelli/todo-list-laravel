<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;

class DiscardingAttributesServiceProvider extends ServiceProvider
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
        Category::preventsSilentlyDiscardingAttributes($this->app->isLocal());
        Category::preventSilentlyDiscardingAttributes($this->app->isLocal());
        Checklist::preventSilentlyDiscardingAttributes($this->app->isLocal());
        Task::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
