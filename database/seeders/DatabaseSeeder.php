<?php

namespace Database\Seeders;

use App\Models\Guild;
use App\Models\Note;
use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();
        Guild::factory(10)->create();
        Note::factory(20)->create();
        PlayerSeason::factory(120)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
