<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryContract
{
    /**
     * Instantiates the categories model.
     * 
     * @return void
     */
    public function __construct(
        private Category $categories
    ) {}

    /**
     * Lists user's registered categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        $categories = auth()->user()->categories;

        return $categories;
    }

    /**
     * Returns the categories trashed registers.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        $categories = $this->categories::onlyTrashed()
                                        ->where('user_id', auth()->user()->id)
                                        ->get();
        return $categories;
    }

    /**
     * Creates a new category.
     * 
     * @param  array  $validated
     * @return \App\Models\Category
     */
    public function store(array $validated): Category
    {
        $category = $this->categories->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'user_id' => auth()->user()->id
        ]);

        return $category;
    }

    /**
     * Returns a category.
     * 
     * @param  string  $id
     * @return \App\Models\Category
     */
    public function show(string $id): Category
    {
        $category = $this->categories::findOrFail($id);

        return $category;
    }

    /**
     * Updates a category.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $id
     * @return \App\Models\Category
     */
    public function update(array $validated, string $id): Category
    {
        $category = $this->categories::findOrFail($id);

        $category->name = $validated['name'];

        if ($category->isDirty('name')) {
            $category->slug = Str::slug($validated['name']);
            $category->save();
        }

        return $category->refresh();
    }

    /**
     * Removes a category.
     * 
     * @param string $id
     */
    public function destroy(string $id): bool
    {
        $category = $this->categories::findOrFail($id);

        return $category->delete();
    }

    /**
     * restores a category.
     * 
     * @param  string  $id
     */
    public function restore(string $id)
    {
        $category = $this->categories::onlyTrashed()->find($id);

        return $category->restore();
    }

    /**
     * Removes a category permanently.
     * 
     * @param  string  $id
     */
    public function force(string $id)
    {
        $category = $this->categories::onlyTrashed()->find($id);

        return $category->forceDelete();
    }
}
