<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_the_teams_page_succesfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/teams');

        $response->assertOk()
                 ->assertViewIs('teams.index');
    }

    public function test_user_has_to_be_logged_in_to_access_the_teams_page(): void
    {
        $response = $this->get('/teams');

        $response->assertRedirectToRoute('login');
    }

    public function test_the_create_team_page_is_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/teams/create');

        $response->assertOk()
                 ->assertViewIs('teams.create');
    }

    public function test_user_can_create_a_new_team_succesfully(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->make();

        $response = $this->actingAs($user)->post('/teams', [
            'name' => $team['name'],
            'description' => $team['description']
        ]);

        $response->assertRedirectToRoute('teams.index');
        
        $this->assertDatabaseCount('teams', 1)
             ->assertDatabaseHas('teams', [
                'name' => $team['name'],
                'description' => $team['description']
            ]);
    }

    public function test_user_can_see_a_team_information(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $response = $this->actingAs($user)->get("/teams/{$team->id}");

        $response->assertOk()
                 ->assertViewIs('teams.show');
    }

    public function test_edit_team_page_is_being_rendered(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $response = $this->actingAs($user)->get("/teams/{$team->id}/edit");

        $response->assertOk()
                 ->assertViewIs('teams.edit');
    }

    public function test_user_can_update_a_team(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $response = $this->actingAs($user)->put("/teams/{$team->id}", [
            'name' => $newName = fake()->word(),
            'description' => $newDescription = fake()->text()
        ]);

        $response->assertRedirectToRoute('teams.show', ['id' => $team->id]);
        
        $this->assertDatabaseCount('teams', 1)
             ->assertDatabaseHas('teams', [
                'name' => $newName,
                'description' => $newDescription
             ]);
    }

    public function test_the_delete_team_view_is_being_rendered(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $response = $this->actingAs($user)->get("/teams/{$team->id}/delete");

        $response->assertOk()
                 ->assertViewIs('teams.delete');
    }

    public function test_user_can_remove_a_team(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $response = $this->actingAs($user)->delete("/teams/{$team->id}");

        $response->assertRedirectToRoute('teams.index');

        $this->assertDatabaseCount('teams', 0)
             ->assertDatabaseMissing('teams', [
                'name' => $team['name']
             ]);
    }
}
