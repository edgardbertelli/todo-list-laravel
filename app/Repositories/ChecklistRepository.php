<?php

namespace App\Repositories;

use App\Contracts\ChecklistContract;
use App\Events\ChecklistCreated;
use App\Events\ChecklistDeleted;
use App\Models\Category;
use App\Models\Checklist;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        ChecklistCreated::dispatch($checklist);

        return $checklist;
    }

    /**
     * Returns a checklist.
     * 
     * @param  string  $slug
     * @return stdClass
     */
    public function show(string $slug): Checklist
    {
        $checklist =  $this->checklists::addSelect([
            'user' => $this->categories::select('user_id')
                                        ->whereColumn('category_id', 'categories.id'),
        ])->get()->where('user', auth()->user()->id)->where('slug', $slug)->first();

        return $checklist;
    }

    /**
     * Updates a checklist.
     * 
     * @param  array  $validated
     * @param  string  $slug
     * @return stdClass
     */
    public function update(array $validated, string $slug): Checklist
    {
        $category = $this->show($slug);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category_id' => $validated['category']
        ]);

        return $category->refresh();
    }

    /**
     * Deletes a checklist.
     * 
     * @todo   Implement the removal of a checklist.
     * @todo   Implement the dispatch of a task removal (event log).
     * @param  string  $slug
     * @return bool
     */
    public function destroy(string $slug): bool
    {
        $checklist = $this->show($slug);

        $checklist->delete();

        ChecklistDeleted::dispatch($checklist);

        return true;
    }
}
