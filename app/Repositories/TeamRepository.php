<?php

namespace App\Repositories;

use App\Contracts\TeamContract;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamContract
{
    public function __construct(
        private Team $teams
    ) {}

    public function index(): Collection
    {
        $teams = auth()->user()->teams;

        return $teams;
    }
}