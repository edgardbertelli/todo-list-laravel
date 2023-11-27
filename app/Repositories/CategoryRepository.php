<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Events\CategoryCreated;
use App\Events\CategoryDeleted;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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
        $categories = $this->categories::where('user_id', Auth::user()->id)->get();

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
            'name'       => $validated['name'],
            'slug'       => Str::slug($validated['name']),
            'user_id'    => Auth::user()->id
        ]);

        CategoryCreated::dispatch($category);
        
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
        return $this->categories::where('id', $id)
                                ->where('user_id', Auth::user()->id)
                                ->first();
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
        $category = $this->categories::where('id', $id)->where('user_id', Auth::user()->id)->first();

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name'])
        ]);

        return $category->refresh();
    }

    /**
     * Removes a category.
     * 
     * @param string $id
     */
    public function destroy(string $id)
    {
        $category = $this->categories::where('id', $id)
                                     ->where('user_id', Auth::user()->id)
                                     ->first();

        $categoryDeleted =  $category->delete();

        CategoryDeleted::dispatch($category);

        return $categoryDeleted;
    }
}
