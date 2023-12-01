<?php

namespace App\Repositories;

use App\Contracts\TeamContract;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamContract
{
    /**
     * Instantiates the teams and users models.
     * 
     * @param  \App\Models\Team  $teams
     * @param  \App\Models\User  $users
     */
    public function __construct(
        private Team $teams,
        private User $users,
    ) {}

    /**
     * Lists all of the teams the user owns or is part of.
     * 
     * @return \Illuminate\Databse\Eloquent\Collection
     */
    public function index(): Collection
    {
        $teams = $this->teams::whereBelongsTo(auth()->user(), 'created_by')
                             ->orWhereRelation('users', 'user_id', auth()->user()->id)
                             ->get();

        return $teams;
    }

    /**
     * Creates a new team.
     * 
     * @param  array  $validated
     * @return \App\Models\Team
     */
    public function store(array $validated): Team
    {
        $team = $this->teams->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'user_id' => auth()->user()->id
        ]);

        auth()->user()->teams()->attach($team->id);

        return $team;
    }

    /**
     * Attaches a user to a team.
     * 
     * @param  array  $validated
     * @param  string $id
     */
    public function attach(array $validated, string $id)
    {
        $user = $this->users::where('email', $validated['email'])->firstOrFail();

        $user->teams()->attach($id);
    }

    /**
     * Find a team by its ID.
     * 
     * @param  string  $id
     * @return \App\Models\Team
     */
    public function show(string $id): Team
    {
        $team = $this->teams::findOrFail($id);

        return $team;
    }

    /**
     * Updates a team data.
     * 
     * @param  string  $id
     * @param  array   $validated
     * @return \App\Models\Team
     */
    public function update(array $validated, string $id): Team
    {
        $team = $this->teams->findOrFail($id);

        $team->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return $team->refresh();
    }

    /**
     * Deletes a team given its ID.
     * 
     * @param  string  $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $team = $this->teams->findOrFail($id);

        return $team->delete();
    }
}