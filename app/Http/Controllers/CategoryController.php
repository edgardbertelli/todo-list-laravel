<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    public function store(Request $request): RedirectResponse
    {
        $this->categories->store($request);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified category.
     * 
     * @param string $category
     */
    public function show(Request $request, string $category): View
    {
        $category = $this->categories->show($category);

        return view('categories.show', [
            'category' => $category,
            'request'  => $request,
        ]);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     */
    public function edit(Request $request, string $category): View
    {
        $category = $this->categories->show($category);

        return view('categories.edit', [
            'category' => $category,
            'request'  => $request,
        ]);
    }

    /**
     * Update the specified category in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     */
    public function update(Request $request, string $category): RedirectResponse
    {
        $category = $this->categories->update($request, $category);

        return redirect()->route('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $category
     */
    public function destroy(string $category): RedirectResponse
    {
        $this->categories->destroy($category);

        $categories = $this->categories->index();

        return redirect()->route('categories.index', [
            'categories' => $categories
        ]);
    }
}
