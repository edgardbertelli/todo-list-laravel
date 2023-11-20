<?php

namespace App\Http\Controllers;

use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(
        private ReportService $reports,
    ) {}

    public function make()
    {
        return $this->reports->make();
    }
}
