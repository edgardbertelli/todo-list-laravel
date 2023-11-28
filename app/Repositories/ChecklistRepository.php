<?php

namespace App\Repositories;

use App\Contracts\ChecklistContract;
use App\Models\project;
use App\Models\Checklist;
use Illuminate\Support\Collection;
use stdClass;

class ChecklistRepository implements ChecklistContract
{
    public function __construct(
        private Checklist $checklists,
        private project $projects,
    ) {}

    /**
     * Lists all the checklists.
     * 
     * @return \Iluminate\Support\Collection
     */
    public function index(): Collection
    {
        $checklists = $this->checklists::whereBelongsTo(auth()->user())->get();

        return $checklists;
    }

    /**
     * Lists all the trashed checklists.
     */
    public function trash(): Collection
    {
        $checklists = $this->checklists::onlyTrashed()
                                        ->whereBelongsTo(auth()->user())
                                        ->get();

        return $checklists;
    }

    /**
     * Restores a checklist.
     * 
     * @param  string  $id
     * @return \App\Models\Checklist
     */
    public function restore(string $id): Checklist
    {
        $checklist = $this->checklists::onlyTrashed()->findOrFail($id);

        return $checklist->restore();
    }

    /**
     * Creates a new checklist.
     * 
     * @param  array  $validated
     * @return bool
     */
    public function store(array $validated): Checklist
    {
        $checklist = $this->checklists->create([
            'name' => $validated['name'],
            'project_id' => $validated['project'],
            'user_id' => auth()->user()->id
        ]);

        return $checklist;
    }

    /**
     * Returns a checklist.
     * 
     * @param  string  $id
     * @return stdClass
     */
    public function show(string $id): Checklist
    {
        $checklist = $this->checklists::findOrFail($id);

        return $checklist;
    }

    /**
     * Updates a checklist.
     * 
     * @param  array  $validated
     * @param  string  $id
     * @return stdClass
     */
    public function update(array $validated, string $id): Checklist
    {
        $checklist = $this->checklists::findOrFail($id);

        $checklist->update([
            'name' => $validated['name'],
            'project_id' => $validated['project']
        ]);

        return $checklist->refresh();
    }

    /**
     * Deletes a checklist.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $checklist = $this->checklists::findOrFail($id);

        return $checklist->delete();
    }

    /**
     * Removes a checklist permanently.
     * 
     * @param  string  $id
     * @return bool
     */
    public function force(string $id): bool
    {
        $checklist = $this->checklists::findOrFail($id);

        return $checklist->forceDelete();
    }
}
