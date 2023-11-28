<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Models\Category;
use App\Models\Checklist;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\ChecklistService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('auth');
        $this->middleware('localized')->except(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $checklists = $this->checklists->index();
        
        return view('checklists.index', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Return all the trashed checklists.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function trash()
    {
        $checklists = $this->checklists->trash();

        return view('checklists.trash', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Restore a checklist.
     * 
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id): RedirectResponse
    {
        $this->checklists->restore($id);

        return redirect()->route('checklists.trash');
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
        $this->checklists->store($request);

        return redirect()->route('checklists.index')
                         ->with('status_message', "The \"{$request->name}\" checklist has been created succesfully!");
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        $checklist  = $this->checklists->show($id);

        return view('checklists.show', [
            'checklist' => $checklist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id): View
    {
        $checklist = $this->checklists->show($id);
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
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateChecklistRequest $request, string $id): RedirectResponse
    {
        $updatedChecklist = $this->checklists->update($request, $id);

        return redirect()->route('checklists.show', [
            'id' => $updatedChecklist->id
        ])->with('status_message', 'The checklist has been update succesfully!');
    }

    /**
     * Returns a view to confirm the removal of a checklist.
     * 
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function delete(string $id): View
    {
        $checklist = $this->checklists->show($id);

        return view('checklists.delete', [
            'checklist' => $checklist
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
        $this->checklists->destroy($slug);

        return redirect()->route('checklists.index')
                         ->with('status_message', 'The checklist has been removed succesfully!');
    }

    /**
     * Removes a checklist permanently.
     * 
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function force(string $id): RedirectResponse
    {
        $this->checklists->force($id);

        return redirect()->route('checklists.trash');
    }
}
