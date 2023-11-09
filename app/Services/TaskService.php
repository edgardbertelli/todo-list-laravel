<?php

namespace App\Services;

use App\Contracts\TaskContract;
use Illuminate\Http\Request;

class TaskService
{
    /**
     * Instantiates the tasks contract.
     * 
     * @return void
     */
    public function __construct(
        private TaskContract $tasks
    ) {}

    /**
     * Lists all the tasks.
     */
    public function index()
    {
        return $this->tasks->index();
    }

    /**
     * Creates a new task.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        return $this->tasks->store($request);
    }

    /**
     * Returns a task.
     * 
     * @param string $slug
     */
    public function show(string $slug)
    {
        return $this->tasks->show($slug);
    }

    public function update(Request $request, string $slug)
    {
        return $this->tasks->update($request, $slug);
    }

    public function destroy(string $slug)
    {
        return $this->tasks->destroy($slug);
    }
}
