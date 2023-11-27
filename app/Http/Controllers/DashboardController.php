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
        $categoriesCount = $this->categories->index()->count();
        $checklistsCount = $this->checklists->index()->count();
        $tasksCount = $this->tasks->index()->count();

        return view('dashboard', compact(['categoriesCount', 'checklistsCount', 'tasksCount']));
    }
}
