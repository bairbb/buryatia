<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Space;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Space::factory()
            ->count(10)
            ->create()
            ->each(function ($space) {
                Image::factory()->count(3)->create(['space_id' => $space->id]);
            });
    }
}