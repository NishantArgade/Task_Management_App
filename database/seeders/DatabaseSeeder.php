<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user with 'user' role
        User::factory()->create([
            'id' => 1,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now()
        ]);

        // Create a user with 'admin' role
        User::factory()->create([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now()
        ]);
     
        // Seed 10 users and 50 tasks
        User::factory(10)->create();
        $tasks = Task::factory(20)->create();

        $users = User::all();

        // Define the possible statuses
        $statuses = ['pending', 'in progress', 'completed'];


        // For each user...
        $tasks->each(function ($task) use ($users, $statuses) {
            // ...attach a random task with a random status
            $task->users()->attach(
                $users->random()->id,
                ['status' => $statuses[array_rand($statuses)]]
            );
        });
    }
}
