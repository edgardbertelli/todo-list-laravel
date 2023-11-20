<?php

namespace App\Listeners;

use App\Events\CategoryStored;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogStoredCategory
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
    public function handle(CategoryStored $event): void
    {
        Log::info("User \"{username}\" has created a new category \"{category}\".", [
            'username' => Auth::user()->username,
            'category' => $event->category->name,
        ]);
    }
}
