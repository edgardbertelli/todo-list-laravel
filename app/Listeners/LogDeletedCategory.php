<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogDeletedCategory
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
    public function handle(CategoryDeleted $event): void
    {
        Log::info("User \"{username}\" has deleted their \"{category}\" category.", [
            'username' => Auth::user()->username,
            'category' => $event->category->name
        ]);
    }
}
