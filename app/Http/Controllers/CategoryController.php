<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    /**
     * Instantiates the categories' service.
     * 
     * @return void
     */
    public function __construct(
        private CategoryService $categories
    ) {
        $this->middleware('localized')->except(['store', 'update', 'destroy']);
    }

    /**
     * Lists all the categories.
     */
    public function index(): View
    {
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
        $categories = $this->categories->index();
        
        return view('categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created category in storage.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categories->store($request);

        return redirect()->route('categories.index')
                         ->with('status_message',
                                "Category \"{$request->name}\" has been created succesfully!");
    }

    /**
     * Display the specified category.
     * 
     * @param string $slug
     */
    public function show(string $slug): View
    {
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
        $updatedCategory = $this->categories->update($request, $slug);

        return redirect()->route('categories.show', ['slug' => $updatedCategory->slug])
                         ->with('status_message', "Category has been updated succesfully!");
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $category
     */
    public function destroy(string $category): RedirectResponse
    {
        $this->categories->destroy($category);

        return redirect()->route('categories.index')
                         ->with('status_message', 'The category has been deleted succesfully.');
    }
}
