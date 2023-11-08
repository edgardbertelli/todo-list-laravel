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
     * @param string $slug
     */
    public function show(string $slug)
    {
        return $this->categories->show($slug);
    }

    /**
     * Updates a category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function update(Request $request, string $slug)
    {
        return $this->categories->update($request, $slug);
    }

    /**
     * Removes a category.
     * 
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        return $this->categories->destroy($slug);
    }
}