<?php

namespace App\Services;

use App\Contracts\CategoryContract;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Instantiates the category interface.
     * 
     * @return void
     */
    public function __construct (
        private CategoryContract $categories
    ) {}

    /**
     * Lists all the categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return $this->categories->index();
    }

    /**
     * Returns a list of all the categories trashed registers.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trash(): Collection
    {
        return $this->categories->trash();
    }

    /**
     * Creates a new category.
     * 
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \App\Models\Category
     */
    public function store(StoreCategoryRequest $request): Category
    {
        $validated = $request->safe()->only(['name']);
    
        return $this->categories->store($validated);
    }

    /**
     * Returns a category.
     * 
     * @param  string  $id
     * @return \App\Models\Category
     */
    public function show(string $id): Category
    {
        return $this->categories->show($id);
    }

    /**
     * Updates a category.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $id
     * @return \App\Models\Category
     */
    public function update(UpdateCategoryRequest $request, string $id): Category
    {
        $validated = $request->safe()->only(['name']);

        return $this->categories->update($validated, $id);
    }

    /**
     * Removes a category.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->categories->destroy($id);
    }

    /**
     * Removes a category permanently.
     * 
     * @param  string  $id
     */
    public function force(string $id)
    {
        return $this->categories->force($id);
    }

    /**
     * restores a category.
     * 
     * @param  string  $id
     */
    public function restore(string $id)
    {
        return $this->categories->restore($id);
    }
}