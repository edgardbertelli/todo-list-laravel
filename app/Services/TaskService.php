<?php

namespace App\Services;

use App\Contracts\TaskContract;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

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
     * @return stdClass
     */
    public function show(string $id): stdClass
    {
        return $this->tasks->show($id);
    }

    /**
     * Updates a task.
     * 
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  string  $id
     * @return stdClass
     */
    public function update(UpdateTaskRequest $request, string $id): stdClass
    {
        $validated = $request->safe()->only(['title', 'description', 'checklist_id']);

        return $this->tasks->update($validated, $id);
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
}
