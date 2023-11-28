<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Log::info("You have created the \"{task}\" task.", [
            'task' => $task->title
        ]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Log::info("You have updated the \"{task}\" task.", [
            'task' => $task->getOriginal('title')
        ]);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Log::info("You have deleted the \"{task}\" task.", [
            'task' => $task->title
        ]);
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        Log::info("You have restored the \"{task}\" task.", [
            'task' => $task->title
        ]);
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        Log::info("You have permanently deleted the \"{task}\" task.", [
            'task' => $task->title
        ]);
    }
}
