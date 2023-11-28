<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\ChecklistService;
use App\Services\TaskService;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function __construct(
        private ProjectService $projects,
        private ChecklistService $checklists,
        private TaskService $tasks
    ) {
        $this->middleware('auth');
        $this->middleware('localized');
    }

    /**
     * Returns the dashboard view.
     * 
     * @param string $locale
     */
    public function index()
    {
        $projectsCount = $this->projects->index()->count();
        $checklistsCount = $this->checklists->index()->count();
        $tasksCount = $this->tasks->index()->count();

        return view('dashboard', compact(['projectsCount', 'checklistsCount', 'tasksCount']));
    }
}
