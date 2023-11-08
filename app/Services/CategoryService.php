<?php

namespace App\Services;

use App\Contracts\CategoryContract;
use Illuminate\Http\Request;

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
     */
    public function index()
    {
        return $this->categories->index();
    }

    /**
     * Creates a new category.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        return $this->categories->store($request);
    }

    /**
     * Returns a category.
     * 
     * @param string $category
     */
    public function show(string $category)
    {
        return $this->categories->show($category);
    }

    /**
     * Updates a category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     */
    public function update(Request $request, string $category)
    {
        return $this->categories->update($request, $category);
    }

    /**
     * Removes a category.
     * 
     * @param string $category
     */
    public function destroy(string $category)
    {
        return $this->categories->destroy($category);
    }
}