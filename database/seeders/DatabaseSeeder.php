<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Checklist;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()
                     ->has(Team::factory()->count(2))
                     ->hasAttached(Team::factory()->count(5))
                     ->has(Project::factory()
                                       ->has(
                                          Checklist::factory()->has(
                                                                 Task::factory()->count(10))
                                          ->count(3)
                                        )->count(3)
                            )
                     ->create([
                        'name' => 'Edgard',
                        'email' => 'bertelliedgard@gmail.com',
                        'username' => 'edgardbertelli'
                    ]);

        $user = User::factory()
                     ->has(Team::factory()->count(2))
                     ->hasAttached(Team::factory()->count(5))
                     ->has(Project::factory()->count(7))
                     ->create([
                        'name' => 'Lenira',
                        'email' => 'lenirabertelli@gmail.com',
                        'username' => 'lenirabertelli'
                    ]);

        $user = User::factory()
                    ->has(Team::factory()->has(Project::factory()->count(2))->count(2))
                    ->hasAttached(Team::factory()->count(5))
                    ->has(Project::factory()->count(13))
                    ->create([
                        'name' => 'Bira',
                        'email' => 'birapereira@gmail.com',
                        'username' => 'birapereira'
                    ]);

        User::factory(100)->create();

        Project::factory()->count(10)->create([
            'user_id' => $user->id
        ]);
    }
}
