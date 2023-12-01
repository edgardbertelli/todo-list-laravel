<?php

namespace App\Services;

use App\Contracts\TeamContract;
use App\Http\Requests\AttachtTeamUserRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamService
{
    /**
     * Instantiates the teams contract.
     * 
     * @param  \App\Contracts\TeamContract
     * @return void
     */
    public function __construct(
        private TeamContract $teams
    ) {}

    /**
     * Lists all the teams the authenticated user
     * has created or is part of.
     * 
     * @return  \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return $this->teams->index();
    }

    /**
     * Creates a new team.
     * 
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \App\Models\Team
     */
    public function store(StoreTeamRequest $request): Team
    {
        $validated = $request->safe()->only(['name', 'description']);

        return $this->teams->store($validated);
    }

    /**
     * Attaches a user to a team.
     * 
     * @param  \App\Http\Requests\AttachtTeamUserRequest  $request
     * @param  string  $id
     */
    public function attach(AttachtTeamUserRequest $request, string $id)
    {
        $validated = $request->safe()->only('email');

        return $this->teams->attach($validated, $id);
    }

    /**
     * Returns a team given its ID.
     * 
     * @param  string  $id
     * @return \App\Models\Team
     */
    public function show(string $id): Team
    {
        return $this->teams->show($id);
    }

    /**
     * Updates a team.
     * 
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  string  $id
     * @return \App\Models\Team
     */
    public function update(UpdateTeamRequest $request, string $id): Team
    {
        $validated = $request->safe()->only(['name', 'description']);

        return $this->teams->update($validated, $id);
    }

    /**
     * Deletes a team given its ID.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->teams->destroy($id);
    }
}