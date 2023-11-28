<?php

namespace App\Providers;

use App\Models\project;
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
        project::preventsSilentlyDiscardingAttributes($this->app->isLocal());
        project::preventSilentlyDiscardingAttributes($this->app->isLocal());
        Checklist::preventSilentlyDiscardingAttributes($this->app->isLocal());
        Task::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
