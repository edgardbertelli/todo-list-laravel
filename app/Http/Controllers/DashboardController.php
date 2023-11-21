<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ChecklistService;
use App\Services\TaskService;

class DashboardController extends Controller
{
    public function __construct(
        private CategoryService $categories,
        private ChecklistService $checklists,
        private TaskService $tasks
    ) {}

    /**
     * Returns the dashboard view.
     * 
     * @param string $locale
     */
    public function index(?string $locale = null)
    {
        return view('dashboard', [
            'categories' => $this->categories->index(),
            'checklists' => $this->checklists->index(),
            'tasks'      => $this->tasks->index(),
        ]);
    }
}
