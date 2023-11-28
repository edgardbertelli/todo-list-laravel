<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Checklist;
use App\Models\Task;
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
                     ->has(Category::factory()
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
                     ->has(Category::factory()->count(7))
                     ->create([
                        'name' => 'Lenira',
                        'email' => 'lenirabertelli@gmail.com',
                        'username' => 'lenirabertelli'
                    ]);

        $user = User::factory()
                    ->has(Category::factory()->count(13))
                    ->create([
                        'name' => 'Bira',
                        'email' => 'birapereira@gmail.com',
                        'username' => 'birapereira'
                    ]);

        User::factory(100)->create();

        Category::factory()->count(10)->create([
            'user_id' => $user->id
        ]);
    }
}
