<?php

namespace App\Services;

use App\Contracts\TaskContract;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    /**
     * Instantiates the tasks contract.
     * 
     * @param  \App\Contracts\TaskContract  $tasks
     * @return void
     */
    public function __construct(
        private TaskContract $tasks
    ) {}

    /**
     * Lists all the tasks.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->tasks->index();
    }

    /**
     * Lists all the trashed tasks.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        return $this->tasks->trash();
    }

    /**
     * Creates a new task.
     * 
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return bool
     */
    public function store(StoreTaskRequest $request): bool
    {
        $validated = $request->safe()->only(['title', 'description', 'checklist_id']);

        return $this->tasks->store($validated);
    }

    /**
     * Returns a task.
     * 
     * @param  string  $id
     * @return Task
     */
    public function show(string $id): Task
    {
        return $this->tasks->show($id);
    }

    /**
     * Updates a task.
     * 
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  string  $id
     * @return Task
     */
    public function update(UpdateTaskRequest $request, string $id): Task
    {
        $validated = $request->safe()->only(['title', 'description', 'checklist_id']);

        return $this->tasks->update($validated, $id);
    }

    /**
     * Restores a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function restore(string $id): bool
    {
        return $this->tasks->restore($id);
    }

    /**
     * Removes a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->tasks->destroy($id);
    }

    /**
     * Forces the removal of a task.
     * 
     * @param  string  $id
     * @return bool
     */
    public function force(string $id): bool
    {
        return $this->tasks->force($id);
    }
}
