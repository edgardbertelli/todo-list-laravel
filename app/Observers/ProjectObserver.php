<?php

namespace App\Observers;

use App\Models\project;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ProjectObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the project "created" event.
     */
    public function created(project $project): void
    {
        Log::info("You have created the \"{project}\" project.", [
            'project' => $project->name
        ]);
    }

    /**
     * Handle the project "updated" event.
     */
    public function updated(project $project): void
    {
        Log::info("You have updated the \"{project}\" project.", [
            'project' => $project->getOriginal('name')
        ]);
    }

    /**
     * Handle the project "deleted" event.
     */
    public function deleted(project $project): void
    {
        Log::info("You have deleted the \"{project}\" project.", [
            'project' => $project->name
        ]);
    }

    /**
     * Handle the project "restored" event.
     */
    public function restored(project $project): void
    {
        Log::info("You have restored the \"{project}\" project.", [
            'project' => $project->name
        ]);
    }

    /**
     * Handle the project "force deleted" event.
     */
    public function forceDeleted(project $project): void
    {
        Log::info("You have permanently deleted the \"{project}\" project.", [
            'project' => $project->name
        ]);
    }
}
