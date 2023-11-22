<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ChecklistService;
use App\Services\TaskService;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function __construct(
        private CategoryService $categories,
        private ChecklistService $checklists,
        private TaskService $tasks
    ) {
        $this->middleware('localized');
    }

    /**
     * Returns the dashboard view.
     * 
     * @param string $locale
     */
    public function index()
    {
        return view('dashboard', [
            'categories' => $this->categories->index(),
            'checklists' => $this->checklists->index(),
            'tasks'      => $this->tasks->index(),
        ]);
    }
}
