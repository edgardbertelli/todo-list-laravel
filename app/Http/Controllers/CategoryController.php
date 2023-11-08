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

        return redirect()->action([CategoryController::class, 'index']);
    }

    /**
     * Display the specified category.
     * 
     * @param string $slug
     */
    public function show(Request $request, string $slug): View
    {
        $category = $this->categories->show($slug);

        return view('categories.show', [
            'category' => $category,
            'request'  => $request,
        ]);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function edit(Request $request, string $slug): View
    {
        $category = $this->categories->show($slug);

        return view('categories.edit', [
            'category' => $category,
            'request'  => $request,
        ]);
    }

    /**
     * Update the specified category in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $updatedCategory = $this->categories->update($request, $slug);

        return redirect()->action(
            [CategoryController::class, 'show'], [
                'request' => $request,
                'slug' => $updatedCategory->slug
                ]
        );
    }

    /**
     * Remove the specified category from storage.
     * 
     * @param string $category
     */
    public function destroy(string $category): RedirectResponse
    {
        $this->categories->destroy($category);

        return redirect()->action([CategoryController::class, 'index']);
    }
}