<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Events\CategoryDestroyed;
use App\Events\CategoryStored;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'user_id'    => Auth::user()->id,
            'created_at' => now(),
        ]);

        CategoryStored::dispatch($category);
        
        return $category;
    }

    /**
     * Returns a category.
     * 
     * @param  string  $slug
     * @return \App\Models\Category
     */
    public function show(string $slug): Category
    {
        return $this->categories::where('slug', $slug)
                                ->where('user_id', Auth::user()->id)
                                ->first();
    }

    /**
     * Updates a category.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $slug
     * @return \App\Models\Category
     */
    public function update(array $validated, string $slug): Category
    {
        $category = $this->categories::where('slug', $slug)->where('user_id', Auth::user()->id)->first();

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name'])
        ]);

        return $category->fresh();
    }

    /**
     * Removes a category.
     * 
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        $category = $this->categories::where('slug', $slug)
                                     ->where('user_id', Auth::user()->id)
                                     ->first();

        $categoryDeleted =  $category->delete();

        CategoryDestroyed::dispatch($category);

        return $categoryDeleted;
    }
}
