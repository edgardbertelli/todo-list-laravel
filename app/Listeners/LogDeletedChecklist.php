<?php

namespace App\Listeners;

use App\Events\ChecklistDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogDeletedChecklist
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
    public function handle(ChecklistDeleted $event): void
    {
        Log::info("User \"{username}\" has deleted their \"{checklist}\" checklist.", [
            'username' => Auth::user()->username,
            'checklist' => $event->checklist->name
        ]);
    }
}
