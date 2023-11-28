<?php

namespace App\Services;

use App\Contracts\projectContract;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * Instantiates the project interface.
     * 
     * @return void
     */
    public function __construct (
        private projectContract $projects
    ) {}

    /**
     * Lists all the projects.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return $this->projects->index();
    }

    /**
     * Returns a list of all the projects trashed registers.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        return $this->projects->trash();
    }

    /**
     * Creates a new project.
     * 
     * @param  \App\Http\Requests\StoreprojectRequest  $request
     * @return \App\Models\project
     */
    public function store(StoreprojectRequest $request): project
    {
        $validated = $request->safe()->only(['name']);
    
        return $this->projects->store($validated);
    }

    /**
     * Returns a project.
     * 
     * @param  string  $id
     * @return \App\Models\project
     */
    public function show(string $id): project
    {
        return $this->projects->show($id);
    }

    /**
     * Updates a project.
     * 
     * @param  \App\Http\Requests\UpdateprojectRequest  $request
     * @param  string  $id
     * @return \App\Models\project
     */
    public function update(UpdateprojectRequest $request, string $id): project
    {
        $validated = $request->safe()->only(['name']);

        return $this->projects->update($validated, $id);
    }

    /**
     * Removes a project.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->projects->destroy($id);
    }

    /**
     * Removes a project permanently.
     * 
     * @param  string  $id
     */
    public function force(string $id)
    {
        return $this->projects->force($id);
    }

    /**
     * restores a project.
     * 
     * @param  string  $id
     */
    public function restore(string $id)
    {
        return $this->projects->restore($id);
    }
}