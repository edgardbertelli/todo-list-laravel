<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Services\CategoryService;
use App\Services\ChecklistService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChecklistController extends Controller
{
    /**
     * Instantiates the checklist service.
     * 
     * @param  \App\Services\ChecklistService  $checklists
     * @param  \App\Services\CategoryService  $categories
     * @return void
     */
    public function __construct(
        private ChecklistService $checklists,
        private CategoryService $categories,
    ) {
        $this->middleware('localized')->except(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        Log::info("Showing the checklists for user '{username}'", [
            'username' => Auth::user()->username
        ]);

        $checklists = $this->checklists->index();
        
        return view('checklists.index', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View
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
     * @param \App\Http\Requests\StoreChecklistRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreChecklistRequest $request): RedirectResponse
    {
        Log::info("Creating new category '{category}' for user '{username}'", [
            'category' => $request->name,
            'username' => Auth::user()->username
        ]);

        $this->checklists->store($request);

        return redirect()->action([ChecklistController::class, 'index']);
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $slug): View
    {
        Log::info("Showing checklist '{checklist}' to user '{username}'", [
            'checklist' => $slug,
            'username' => Auth::user()->username
        ]);

        $checklist  = $this->checklists->show($slug);

        return view('checklists.show', [
            'checklist' => $checklist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $slug): View
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
     * @param  \App\Http\Requests\UpdateChecklistRequest  $request
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateChecklistRequest $request, string $slug): RedirectResponse
    {
        Log::info("Updating checklist '{checklist}' from user '{username}'", [
            'checklist' => $slug,
            'username' => Auth::user()->username
        ]);

        $updatedChecklist = $this->checklists->update($request, $slug);

        return redirect()->route('checklists.show', [
            'slug' => $updatedChecklist->slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug): RedirectResponse
    {
        Log::info("Deleting checklist '{checklist}' from user '{username}'", [
            'checklist' => $slug,
            'username' => Auth::user()->username
        ]);

        $this->checklists->destroy($slug);

        return redirect()->route('checklists.index');
    }
}
