<?php

namespace App\Repositories;

use App\Contracts\ReportContract;
use App\Jobs\ProcessReport;
use App\Models\project;
use App\Models\Checklist;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportRepository implements ReportContract
{
    public function __construct(
        private project $projects,
        private Checklist $checklists,
        private Task $tasks,
    ) {}

    /**
     * Generates a report for the user.
     */
    public function make()
    {
        $projects = $this->projects::where('user_id', Auth::user()->id)->get();
        $checklists = $this->checklists::all();
        $tasks = $this->tasks::all();

        $pdf = Pdf::loadView('pdf.report', [
            'projects' => $projects,
            'checklists' => $checklists,
            'tasks'      => $tasks
        ]);

        $report = $pdf->download('report.pdf');

        ProcessReport::dispatch($report);
    }
}