<?php

namespace App\Observers;

use App\Models\Checklist;
use Illuminate\Support\Facades\Log;

class ChecklistObserver
{
    /**
     * Handle the Checklist "created" event.
     */
    public function created(Checklist $checklist): void
    {
        Log::info("You have created the \"{checklist}\" checklist.", [
            'checklist' => $checklist->name
        ]);
    }

    /**
     * Handle the Checklist "updated" event.
     */
    public function updated(Checklist $checklist): void
    {
        Log::info("You have updated the \"{checklist}\" checklist.", [
            'checklist' => $checklist->getOriginal('name')
        ]);
    }

    /**
     * Handle the Checklist "deleted" event.
     */
    public function deleted(Checklist $checklist): void
    {
        Log::info("You have deleted the \"{checklist}\" checklist.", [
            'checklist' => $checklist->name
        ]);
    }

    /**
     * Handle the Checklist "restored" event.
     */
    public function restored(Checklist $checklist): void
    {
        Log::info("You have restored the \"{checklist}\" checklist.", [
            'checklist' => $checklist->name
        ]);
    }

    /**
     * Handle the Checklist "force deleted" event.
     */
    public function forceDeleted(Checklist $checklist): void
    {
        Log::info("You have permanently deleted the \"{checklist}\" checklist in the \"{category}\" category,", [
            'checklist' => $checklist->name,
            'category'  => $checklist->category->name
        ]);
    }
}
