<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryContract
{
    /**
     * Instantiates the categories' model.
     * 
     * @return void
     */
    public function __construct(
        private Category $categories,
    ) {}

    /**
     * Lists user's registered categories.
     */
    public function index()
    {
        return $this->categories::all();
    }

    /**
     * Creates a new category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        return $this->categories::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Returns a category.
     * 
     * @param string $category
     */
    public function show(string $category)
    {
        return $this->categories::where('name', $category)
                                ->where('user_id', Auth::user()->id)
                                ->first();
    }

    /**
     * Updates a category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     */
    public function update(Request $request, string $category)
    {
        $category = $this->categories::where('name', $category)
                                     ->where('user_id', Auth::user()->id)
                                     ->first();

        $category->update([
            'name' => $request->name
        ]);

        return $category->fresh();
    }

    /**
     * Removes a category.
     * 
     * @param string $category
     */
    public function destroy(string $category)
    {
        $category = $this->categories::where('name', $category)
                                      ->where('user_id', Auth::user()->id)
                                      ->first();

        return $category->delete();
    }
}
