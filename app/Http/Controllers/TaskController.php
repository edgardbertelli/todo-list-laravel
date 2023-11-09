<?php

namespace App\Http\Controllers;

use App\Services\ChecklistService;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Instantiates the tasks service.
     * 
     * @return void
     */
    public function __construct(
        private TaskService $tasks,
        private ChecklistService $checklists,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->tasks->index();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $checklists = $this->checklists->index();

        return view('tasks.create', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->tasks->store($request);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     * 
     * @param string $slug
     */
    public function show(string $slug)
    {
        $task = $this->tasks->show($slug);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $slug
     */
    public function edit(string $slug)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     */
    public function update(Request $request, string $slug)
    {
        $updatedTask = $this->tasks->update($request, $slug);

        return redirect()->route('tasks.show', [
            'slug' => $updatedTask->slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        $this->tasks->destroy($slug);

        return redirect()->route('tasks.index');
    }
}
