<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Instantiates the categories' service.
     * 
     * @return void
     */
    public function __construct(
        private CategoryService $categories
    ) {}

    /**
     * Lists all the categories.
     */
    public function index(): View
    {
        Log::info("Showing the categories of the user '{username}'", [
            'username' => Auth::user()->username
        ]);

        $categories = $this->categories->index();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Log::info("Creating new category '{category}' for user '{username}'", [
            'username' => Auth::user()->username,
            'category' => $request->name
        ]);

        $this->categories->store($request);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified category.
     * 
     * @param string $slug
     */
    public function show(string $slug): View
    {
        Log::info("Showing category '{category}' to user '{username}'", [
            'category' => $slug,
            'username' => Auth::user()->username
        ]);

        $category = $this->categories->show($slug);

        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @param string $slug
     */
    public function edit(string $slug): View
    {
        $category = $this->categories->show($slug);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified category in storage.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $slug
     */
    public function update(UpdateCategoryRequest $request, string $slug): RedirectResponse
    {
        Log::info("Updating category '{category}' from user '{username}'", [
            'category' => $slug,
            'username' => Auth::user()->username
        ]);

        $updatedCategory = $this->categories->update($request, $slug);

        return redirect()->route('categories.show', [
            'slug' => $updatedCategory->slug
        ]);
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $category
     */
    public function destroy(string $category): RedirectResponse
    {
        Log::info("Deleting category '{category}' from user '{username}'", [
            'category' => $category,
            'username' => Auth::user()->username
        ]);

        $this->categories->destroy($category);

        return redirect()->route('categories.index');
    }
}
