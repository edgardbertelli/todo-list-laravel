<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachtTeamUserRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Services\TeamService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TeamController extends Controller
{
    public function __construct(
        private TeamService $teams
    ) {
        $this->middleware('auth');
        $this->middleware('localized')->except(['store', 'update', 'destroy', 'attach']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teams = $this->teams->index();

        return view('teams.index', compact(['teams']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $this->teams->store($request);

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $team = $this->teams->show($id);

        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $team = $this->teams->show($id);

        return view('teams.edit', compact(['team']));
    }

    /**
     * Show the form to look for the new member of the team.
     */
    public function add(string $id): View
    {
        $team = $this->teams->show($id);

        return view('teams.add', compact('team'));
    }

    /**
     * Attach a user to a team.
     */
    public function attach(AttachtTeamUserRequest $request, string $id)
    {
        $this->teams->attach($request, $id);

        return redirect()->route('teams.show', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, string $id)
    {
        $team = $this->teams->update($request, $id);

        return redirect()->route('teams.show', [
            'id' => $team->id
        ]);
    }

    /**
     * Shows a team removal confirmation.
     */
    public function delete(string $id): View
    {
        $team = $this->teams->show($id);

        return view('teams.delete', [
            'id' => $team->id,
            'team' => $team
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->teams->destroy($id);

        return redirect()->route('teams.index');
    }
}
