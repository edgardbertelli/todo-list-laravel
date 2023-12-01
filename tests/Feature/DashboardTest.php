<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_the_welcome_page_is_being_returned_succesfully(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }
    
    public function test_user_has_to_be_logged_in_to_access_the_app(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirectToRoute('login');
    }

    public function test_user_is_logging_in_succesfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/dashboard');

        $response->assertOk();
    }
}
