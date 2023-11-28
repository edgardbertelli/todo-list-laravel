<?php

namespace App\Providers;

use App\Contracts\projectContract;
use App\Contracts\ChecklistContract;
use App\Contracts\ReportContract;
use App\Contracts\TaskContract;
use App\Contracts\TeamContract;
use App\Repositories\TaskRepository;
use App\Repositories\ChecklistRepository;
use App\Repositories\projectRepository;
use App\Repositories\ReportRepository;
use App\Repositories\TeamRepository;
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
        $this->app->bind(projectContract::class, projectRepository::class);
        $this->app->bind(ChecklistContract::class, ChecklistRepository::class);
        $this->app->bind(TaskContract::class, TaskRepository::class);
        $this->app->bind(ReportContract::class, ReportRepository::class);
        $this->app->bind(TeamContract::class, TeamRepository::class);
    }
}
