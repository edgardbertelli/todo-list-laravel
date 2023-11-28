<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Instantiates the projects' service.
     * 
     * @return void
     */
    public function __construct(
        private ProjectService $projects
    ) {
        $this->middleware('auth');
        $this->middleware('localized')->except(['store', 'update', 'destroy', 'force', 'restore']);
    }

    /**
     * Lists all the projects.
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $projects = project::addSelect([
            'users' => User::select('id')
                        ->whereColumn('user_id', 'users.id')
        ])->where('user_id', $userId)->get();

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Returns a page with a list of the projects trashed registers.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function trash(): View
    {
        $projects = $this->projects->trash();

        return view('projects.trash', [
            'projects' => $projects
        ]);
    }

    /**
     * Returns a page to confirm the removal of a project.
     * 
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function delete(string $id): View
    {
        $project = $this->projects->show($id);

        return view('projects.delete', [
            'project' => $project
        ]);
    }

    /**
     * Removes a project permanently.
     * 
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function force(string $id): RedirectResponse
    {
        $this->projects->force($id);

        return redirect()->route('projects.trash');
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $projects = $this->projects->index();
        
        return view('projects.create', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created project in storage.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(StoreprojectRequest $request): RedirectResponse
    {
        $this->projects->store($request);

        return redirect()->route('projects.index')
                         ->with('status_message',
                                "project \"{$request->name}\" has been created succesfully!");
    }

    /**
     * Display the specified project.
     * 
     * @param string $id
     */
    public function show(string $id): View
    {
        $project = $this->projects->show($id);

        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified project.
     * 
     * @param string $id
     */
    public function edit(string $id): View
    {
        $project = $this->projects->show($id);

        return view('projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified project in storage.
     * 
     * @param  \App\Http\Requests\UpdateprojectRequest  $request
     * @param  string  $id
     */
    public function update(UpdateprojectRequest $request, string $id): RedirectResponse
    {
        $updatedproject = $this->projects->update($request, $id);

        return redirect()->route('projects.show', ['id' => $updatedproject->id])
                         ->with('status_message', "project has been updated succesfully!");
    }

    /**
     * Remove the specified project from storage.
     * 
     * @param string $id
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->projects->destroy($id);

        return redirect()->route('projects.index')
                         ->with('status_message', 'The project has been deleted succesfully.');
    }

    /**
     * restores a project.
     * 
     * @param  string  $id
     */
    public function restore(string $id): RedirectResponse
    {
        $this->projects->restore($id);

        return redirect()->route('projects.index');
    }
}
