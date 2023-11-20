<?php

namespace App\Repositories;

use App\Contracts\ReportContract;
use App\Jobs\ProcessReport;
use App\Models\Category;
use App\Models\Checklist;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportRepository implements ReportContract
{
    public function __construct(
        private Category $categories,
        private Checklist $checklists,
        private Task $tasks,
    ) {}

    /**
     * Generates a report for the user.
     */
    public function make()
    {
        $categories = $this->categories::where('user_id', Auth::user()->id)->get();
        $checklists = $this->checklists::all();
        $tasks = $this->tasks::all();

        $pdf = Pdf::loadView('pdf.report', [
            'categories' => $categories,
            'checklists' => $checklists,
            'tasks'      => $tasks
        ]);

        $report = $pdf->download('report.pdf');

        ProcessReport::dispatch($report);
    }
}