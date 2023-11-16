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
     * @param  string  $slug
     * @return stdClass
     */
    public function show(string $slug): stdClass
    {
        return $this->tasks->show($slug);
    }

    /**
     * Updates a task.
     * 
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  string  $slug
     * @return stdClass
     */
    public function update(UpdateTaskRequest $request, string $slug): stdClass
    {
        $validated = $request->safe()->only(['title', 'description', 'category_id']);
        return $this->tasks->update($validated, $slug);
    }

    /**
     * Removes a task.
     * 
     * @param  string  $slug
     * @return bool
     */
    public function destroy(string $slug): bool
    {
        return $this->tasks->destroy($slug);
    }
}
