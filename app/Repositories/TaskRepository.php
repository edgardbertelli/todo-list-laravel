<?php

namespace App\Repositories;

use App\Contracts\TaskContract;
use App\Models\Category;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class TaskRepository implements TaskContract
{
    public function __construct(
        private Task $tasks,
        private Checklist $checklists,
        private Category $categories,
    ) {}

    /**
     * Lists all the tasks.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->tasks::all();
    }

    /**
     * Lists all the trashed tasks.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        return $this->tasks::onlyTrashed()->get();
    }

    /**
     * Creates a new task.
     * 
     * @param  array  $validated
     * @return bool
     */
    public function store(array $validated): bool
    {

        $task = DB::table('tasks')->insert([
            'title'        => $validated['title'],
            'slug'         => Str::slug($validated['title']),
            'description'  => $validated['description'],
            'checklist_id' => $validated['checklist_id'],
            'created_at'   => now()
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
            'slug' => Str::slug($validated['title']),
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
