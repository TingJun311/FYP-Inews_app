<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Default seeding without factory
        // \App\Models\Bookmarks::create([
        //     'author' => null,
        //     'title' => "testing",
        //     'description' => null,
        //     'url' => null,
        //     'urlToImage' => null,
        // ]);

        $user = \App\Models\User::factory()->create([
            'name' => "John Doe",
            'email' => 'Jojj@gmail.com'
        ]);
        \App\Models\Bookmarks::factory(3)->create([
            'user_id' => $user->id
        ]);
    }
}
