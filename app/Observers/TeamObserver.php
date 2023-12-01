<?php

namespace App\Observers;

use App\Models\Team;
use Illuminate\Support\Facades\Log;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        Log::info("You have created the \"{team}\" team.", [
            'team' => $team->name
        ]);
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        Log::info("You have updated the \"{team}\" team.", [
            'team' => $team->name
        ]);
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        Log::info("You have deleted the \"{team}\" team.", [
            'team' => $team->name
        ]);
    }
}
