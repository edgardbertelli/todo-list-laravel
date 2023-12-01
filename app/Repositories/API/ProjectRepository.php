<?php

namespace App\Repositories\API;

use App\Contracts\API\ProjectContract;
use App\Models\Project;

class ProjectRepository implements ProjectContract
{
    public function __construct(
        private Project $projects
    ) {}

    public function index()
    {
        return $this->projects::all();
    }
}