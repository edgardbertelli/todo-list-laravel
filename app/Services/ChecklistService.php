<?php

namespace App\Services;

use App\Contracts\ChecklistContract;
use Illuminate\Http\Request;

class ChecklistService
{
    /**
     * Instantiates the checklists interface.
     * 
     * @return void
     */
    public function __construct(
        private ChecklistContract $checklists
    ) {}

    /**
     * Lists all checklists.
     */
    public function index()
    {
        return $this->checklists->index();
    }

    /**
     * Creates a new checklsist.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        return $this->checklists->store($request);
    }

    /**
     * Returns a checklist.
     * 
     * @param string $slug
     */
    public function show(string $slug)
    {
        return $this->checklists->show($slug);
    }

    public function update(Request $request, string $slug)
    {
        return $this->checklists->update($request, $slug);
    }
}