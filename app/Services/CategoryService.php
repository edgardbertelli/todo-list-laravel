<?php

namespace App\Services;

use App\Contracts\CategoryContract;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        return $this->categories->index();
    }

    /**
     * Creates a new category.
     * 
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \App\Contracts\CategoryContract
     */
    public function store(StoreCategoryRequest $request): CategoryContract
    {
        $validated = $request->safe()->only(['name']);
    
        return $this->categories->store($validated);
    }

    /**
     * Returns a category.
     * 
     * @param  string  $slug
     * @return App\Contracts\CategoryContract
     */
    public function show(string $slug): CategoryContract
    {
        return $this->categories->show($slug);
    }

    /**
     * Updates a category.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $slug
     * @return \App\Contracts\CategoryContract
     */
    public function update(UpdateCategoryRequest $request, string $slug): CategoryContract
    {
        $validated = $request->safe()->only(['name']);

        return $this->categories->update($validated, $slug);
    }

    /**
     * Removes a category.
     * 
     * @param  string  $slug
     * @return \App\Contracts\CategoryContract
     */
    public function destroy(string $slug): CategoryContract
    {
        return $this->categories->destroy($slug);
    }
}