<?php

namespace App\Repositories;

use App\Contracts\projectContract;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectContract
{
    /**
     * Instantiates the projects model.
     * 
     * @return void
     */
    public function __construct(
        private Project $projects
    ) {}

    /**
     * Lists user's registered projects.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        $projects = $this->projects::whereBelongsTo(auth()->user())->get();

        return $projects;
    }

    /**
     * Returns the projects trashed registers.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        $projects = $this->projects::onlyTrashed()
                                        ->whereBelongsTo(auth()->user())
                                        ->get();
        return $projects;
    }

    /**
     * Creates a new project.
     * 
     * @param  array  $validated
     * @return \App\Models\project
     */
    public function store(array $validated): project
    {
        $project = $this->projects->create([
            'name' => $validated['name'],
            'user_id' => auth()->user()->id
        ]);

        return $project;
    }

    /**
     * Returns a project.
     * 
     * @param  string  $id
     * @return \App\Models\project
     */
    public function show(string $id): project
    {
        $project = $this->projects::findOrFail($id);

        return $project;
    }

    /**
     * Updates a project.
     * 
     * @param  \App\Http\Requests\UpdateprojectRequest  $request
     * @param  string  $id
     * @return \App\Models\project
     */
    public function update(array $validated, string $id): project
    {
        $project = $this->projects::findOrFail($id);

        $project->name = $validated['name'];

        if ($project->isDirty('name')) {
            $project->save();
        }

        return $project->refresh();
    }

    /**
     * Removes a project.
     * 
     * @param string $id
     */
    public function destroy(string $id): bool
    {
        $project = $this->projects::findOrFail($id);

        return $project->delete();
    }

    /**
     * restores a project.
     * 
     * @param  string  $id
     */
    public function restore(string $id)
    {
        $project = $this->projects::onlyTrashed()->findOrFail($id);

        return $project->restore();
    }

    /**
     * Removes a project permanently.
     * 
     * @param  string  $id
     * @return bool
     */
    public function force(string $id): bool
    {
        $project = $this->projects::onlyTrashed()->findOrFail($id);

        return $project->forceDelete();
    }
}
