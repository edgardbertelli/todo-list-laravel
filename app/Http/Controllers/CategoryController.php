<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('auth');
        $this->middleware('localized')->except(['store', 'update', 'destroy']);
    }

    /**
     * Lists all the categories.
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $categories = Category::addSelect([
            'users' => User::select('id')
                        ->whereColumn('user_id', 'users.id')
        ])->where('user_id', $userId)->get();

        // $categories = $this->categories->index();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Returns a page with a list of the categories trashed registers.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function trash_index(): View
    {
        $categories = $this->categories->trash_index();

        return view('categories.trash.index', [
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
     * @param string $id
     */
    public function show(string $id): View
    {
        $category = $this->categories->show($id);

        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @param string $id
     */
    public function edit(string $id): View
    {
        $category = $this->categories->show($id);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified category in storage.
     * 
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  string  $id
     */
    public function update(UpdateCategoryRequest $request, string $id): RedirectResponse
    {
        $updatedCategory = $this->categories->update($request, $id);

        return redirect()->route('categories.show', ['id' => $updatedCategory->id])
                         ->with('status_message', "Category has been updated succesfully!");
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $id
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->categories->destroy($id);

        return redirect()->route('categories.index')
                         ->with('status_message', 'The category has been deleted succesfully.');
    }
}
