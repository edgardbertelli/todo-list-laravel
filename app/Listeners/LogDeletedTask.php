<?php

namespace App\Listeners;

use App\Events\TaskDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogDeletedTask
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
    public function handle(TaskDeleted $event): void
    {
        Log::info("User \"{username}\" has deleted their \"{task}\" task.", [
            'username' => Auth::user()->username,
            'task' => $event->task->title
        ]);
    }
}
