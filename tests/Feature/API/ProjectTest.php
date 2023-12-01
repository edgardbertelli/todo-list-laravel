<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_projects_are_being_listed_succesfully(): void
    {
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->getJson('/api/projects');

        $response->assertOk();
    }

    public function test_user_has_to_be_logged_in_to_list_the_projects(): void
    {
        $response = $this->getJson('/api/projects');

        $response->assertUnauthorized();
    }
}
