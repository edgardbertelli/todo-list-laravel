<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\ChecklistService;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Instantiates tasks and checklists services.
     * 
     * @param  \App\Services\TaskService  $tasks
     * @param  \App\ChecklistService  $checklists
     * @return void
     */
    public function __construct(
        private TaskService $tasks,
        private ChecklistService $checklists
    ) {
        $this->middleware('localized')->except(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
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
    public function update(UpdateTaskRequest $request, string $slug): RedirectResponse
    {
        $task = $this->tasks->update($request, $slug);

        return redirect()->route('tasks.show', [
            'slug' => $task->slug
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
        $this->tasks->destroy($slug);

        return redirect()->route('tasks.index');
    }
}
