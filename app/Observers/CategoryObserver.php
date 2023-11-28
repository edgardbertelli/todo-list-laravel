<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class CategoryObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        Log::info("You have created the \"{category}\" category.", [
            'category' => $category->name
        ]);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        Log::info("You have updated the \"{category}\" category.", [
            'category' => $category->getOriginal('name')
        ]);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        Log::info("You have deleted the \"{category}\" category.", [
            'category' => $category->name
        ]);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        Log::info("You have restored the \"{category}\" category.", [
            'category' => $category->name
        ]);
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        Log::info("You have permanently deleted the \"{category}\" category.", [
            'category' => $category->name
        ]);
    }
}
