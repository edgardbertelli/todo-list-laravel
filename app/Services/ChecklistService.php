<?php

namespace App\Services;

use App\Contracts\ChecklistContract;
use Illuminate\Support\Collection;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Models\Checklist;
use stdClass;

class ChecklistService
{
    /**
     * Instantiates the checklists interface.
     * 
     * @param  \App\Constracts\ChecklistContract  $checklists
     * @return void
     */
    public function __construct(
        private ChecklistContract $checklists
    ) {}

    /**
     * Lists all checklists.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->checklists->index();
    }

    /**
     * Creates a new checklsist.
     * 
     * @param \App\Http\Requests\StoreChecklistRequest $request
     * @return bool
     */
    public function store(StoreChecklistRequest $request): Checklist
    {
        $validated = $request->safe()->only(['name', 'category']);

        return $this->checklists->store($validated);
    }

    /**
     * Returns a checklist.
     * 
     * @param  string  $id
     * @return stdClass
     */
    public function show(string $id): Checklist
    {
        return $this->checklists->show($id);
    }

    /**
     * Updates a checklist.
     * 
     * @param  \App\Http\Requests\UpdateChecklistRequest  $request
     * @param  string  @id
     * @return stdClass
     */
    public function update(UpdateChecklistRequest $request, string $id): Checklist
    {
        $validated = $request->safe()->only(['name', 'category']);

        return $this->checklists->update($validated, $id);
    }

    /**
     * Removes a checklist.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->checklists->destroy($id);
    }
}