<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Services\ChecklistService;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Instantiates the tasks service.
     * 
     * @param  \App\Services\TaskService  $tasks
     * @param  \App\Services\ChecklistService  $checklists
     * @return void
     */
    public function __construct(
        private TaskService $tasks,
        private ChecklistService $checklists,
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        Log::info("Showing tasks to user'{username}'", [
            'username' => Auth::user()->username
        ]);

        $tasks = $this->tasks->index();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $checklists = $this->checklists->index();

        return view('tasks.create', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Log::info("Creating a new task '{task}' for user '{username}'", [
            'task' => $request->title,
            'username' => Auth::user()->username
        ]);

        $this->tasks->store($request);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $slug): View
    {
        Log::info("Showing task '{task}', to user '{username}'", [
            'task' => $slug,
            'username' => Auth::user()->username
        ]);

        $task = $this->tasks->show($slug);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $slug): View
    {
        $task = $this->tasks->show($slug);
        $checklists = $this->checklists->index();

        return view('tasks.edit', [
            'task' => $task,
            'checklists' => $checklists
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateChecklistRequest $request, string $slug): RedirectResponse
    {
        Log::info("Updating task '{}' from user '{username}'", [
            'task' => $slug,
            'username' => Auth::user()->username
        ]);

        $updatedTask = $this->tasks->update($request, $slug);

        return redirect()->route('tasks.show', [
            'slug' => $updatedTask->slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug): RedirectResponse
    {
        Log::info("Deleting task '{task}' from user '{username}'", [
            'task' => $slug,
            'username' => Auth::user()->username
        ]);

        $this->tasks->destroy($slug);

        return redirect()->route('tasks.index');
    }
}
