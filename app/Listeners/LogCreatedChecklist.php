<?php

namespace App\Listeners;

use App\Events\ChecklistCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogCreatedChecklist
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChecklistCreated $event): void
    {
        Log::info("User \"{username}\" has created a new \"{checklist}\" checklist.", [
            'username' => Auth::user()->username,
            'checklist' => $event->checklist->name
        ]);
    }
}
