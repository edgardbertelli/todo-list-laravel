<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'Edgard',
                'email' => 'bertelliedgard@gmail.com',
                'username' => 'edgardbertelli'
        ]);

        User::factory()
            ->create([
                'name' => 'Lenira',
                'email' => 'lenirabertelli@gmail.com',
                'username' => 'lenirabertelli'
        ]);

        User::factory()
            ->create([
                'name' => 'Bira',
                'email' => 'birapereira@gmail.com',
                'username' => 'birapereira'
        ]);
    }
}
