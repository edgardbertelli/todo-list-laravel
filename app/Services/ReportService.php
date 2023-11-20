<?php

namespace App\Services;

use App\Contracts\ReportContract;

class ReportService
{
    public function __construct(
        private ReportContract $reports,
    ) {}

    public function make()
    {
        return $this->reports->make();
    }
}