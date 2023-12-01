<?php

namespace App\Services\API;

use App\Contracts\API\ProjectContract;

class ProjectService
{
    public function __construct(
        private ProjectContract $projects
    ) {}

    public function index()
    {
        return $this->projects->index();
    }
}