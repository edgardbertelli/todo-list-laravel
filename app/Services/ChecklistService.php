<?php

namespace App\Services;

use App\Contracts\ChecklistContract;
use Illuminate\Support\Collection;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
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
    public function store(StoreChecklistRequest $request): bool
    {
        $validated = $request->safe()->only(['name', 'category_id']);

        return $this->checklists->store($validated);
    }

    /**
     * Returns a checklist.
     * 
     * @param  string  $slug
     * @return stdClass
     */
    public function show(string $slug): stdClass
    {
        return $this->checklists->show($slug);
    }

    /**
     * Updates a checklist.
     * 
     * @param  \App\Http\Requests\UpdateChecklistRequest  $request
     * @param  string  @slug
     * @return stdClass
     */
    public function update(UpdateChecklistRequest $request, string $slug): stdClass
    {
        $validated = $request->safe()->only(['name', 'category_id']);

        return $this->checklists->update($validated, $slug);
    }

    /**
     * Removes a checklist.
     * 
     * @param  string  $slug
     * @return bool
     */
    public function destroy(string $slug): bool
    {
        return $this->checklists->destroy($slug);
    }
}