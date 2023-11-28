<?php

namespace App\Repositories;

use App\Contracts\ChecklistContract;
use App\Models\Category;
use App\Models\Checklist;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use stdClass;

class ChecklistRepository implements ChecklistContract
{
    public function __construct(
        private Checklist $checklists,
        private Category $categories,
    ) {}

    /**
     * Lists all the checklists.
     * 
     * @return \Iluminate\Support\Collection
     */
    public function index(): Collection
    {
        $checklists = $this->checklists::addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id);

        return $checklists;
    }

    /**
     * Lists all the trashed checklists.
     */
    public function trash()
    {
        return $this->checklists::onlyTrashed()->addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id);
    }

    /**
     * Restores a checklist.
     * 
     * @param  string  $id
     */
    public function restore(string $id)
    {
        $checklist =  $this->checklists::onlyTrashed()->addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id)->where('id', $id)->firstOrFail();

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
            'slug' => Str::slug($validated['name']),
            'category_id' => $validated['category']
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
        $checklist =  $this->checklists::addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id)->where('id', $id)->firstOrFail();

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
        $checklist = $this->show($id);

        $checklist->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category_id' => $validated['category']
        ]);

        return $checklist->refresh();
    }

    /**
     * Deletes a checklist.
     * 
     * @todo   Implement the removal of a checklist.
     * @todo   Implement the dispatch of a task removal (event log).
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $checklist = $this->show($id);

        $checklist->delete();

        return true;
    }

    /**
     * Removes a checklist permanently.
     * 
     * @param  string  $id
     * @return bool
     */
    public function force(string $id): bool
    {
        $checklist =  $this->checklists::onlyTrashed()->addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id)->where('id', $id)->firstOrFail();

        return $checklist->forceDelete();
    }
}
