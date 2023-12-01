<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testUserIsLoggingInSuccesfully(): void
    {
        $user = User::factory()->create([
            'email' => 'bertelliedgard@gmail.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visitRoute('login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('login')
                    ->assertPathIs('/dashboard');
        });
    }
}
