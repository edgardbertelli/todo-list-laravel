<?php

namespace App\Listeners;

use App\Events\CategoryDestroyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogDestroyedCategory
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
    public function handle(CategoryDestroyed $event): void
    {
        Log::info("User \"{username}\" has destroyed their category \"{category}\".", [
            'username' => Auth::user()->username,
            'category' => $event->category->name,
        ]);
    }
}
