<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ChecklistService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Instantiates the checklist service.
     * 
     * @return void
     */
    public function __construct(
        private ChecklistService $checklists,
        private CategoryService $categories,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $checklists = $this->checklists->index();
        
        return view('checklists.index', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = $this->categories->index();

        return view('checklists.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request): RedirectResponse
    {
        $checklist = $this->checklists->store($request);

        return redirect()->action([ChecklistController::class, 'index']);
    }

    /**
     * Display the specified resource.
     * 
     * @param string $slug
     */
    public function show(string $slug)
    {
        $checklist  = $this->checklists->show($slug);

        return view('checklists.show', [
            'checklist' => $checklist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $slug
     */
    public function edit(string $slug)
    {
        $checklist = $this->checklists->show($slug);
        $categories = $this->categories->index();

        return view('checklists.edit', [
            'checklist' => $checklist,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function update(Request $request, string $slug)
    {
        $updatedChecklist = $this->checklists->update($request, $slug);

        return redirect()->route('checklists.show', [
            'slug' => $updatedChecklist->slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
