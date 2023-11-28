<?php

namespace App\Repositories;

use App\Contracts\TaskContract;
use App\Models\project;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskContract
{
    public function __construct(
        private Task $tasks,
        private Checklist $checklists,
        private project $projects,
    ) {}

    /**
     * Lists all the tasks.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->tasks::whereBelongsTo(auth()->user())->get();
    }

    /**
     * Lists all the trashed tasks.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        $tasks = $this->tasks::onlyTrashed()
                              ->whereBelongsTo(auth()->user(), 'user_id')
                              ->get();

        return $tasks;
    }

    /**
     * Creates a new task.
     * 
     * @param  array  $validated
     * @return \App\Models\Task
     */
    public function store(array $validated): Task
    {
        $task = $this->tasks->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
            'checklist_id' => $validated['checklist_id']
        ]);

        return $task;
    }

    /**
     * Returns a task.
     * 
     * @param  string  $id
     * @return Task
     */
    public function show(string $id): Task
    {
        $task = $this->tasks::find($id);

        return $task;
    }

    /**
     * Updates a task.
     * 
     * @param  array  $validated
     * @param  string  $id
     * @return Task
     */
    public function update(array $validated, string $id): Task
    {
        $task = $this->tasks::findOrFail($id);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'checklist_id' => $validated['checklist_id']
        ]);

        return $task->refresh();
    }

    /**
     * Restores a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function restore(string $id): bool
    {
        $task = $this->tasks::onlyTrashed()->findOrFail($id);

        return $task->restore();
    }

    /**
     * Removes a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $task = $this->tasks->findOrFail($id);

        return $task->delete();
    }

    /**
     * Forces the removal of a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function force(string $id): bool
    {
        $task = $this->tasks::onlyTrashed()->findOrFail($id);

        return $task->forceDelete();
    }
}
