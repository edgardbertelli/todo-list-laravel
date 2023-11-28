<?php

namespace App\Services;

use App\Contracts\TeamContract;

class TeamService
{
    public function __construct(
        private TeamContract $teams
    ) {}

    public function index()
    {
        return $this->teams->index();
    }
}