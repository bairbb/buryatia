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

         User::factory()->create([
           'name' => 'Test Admin',
           'email' => 'bair3b@gmail.com',
           'password' => bcrypt('cidjik-kocky1-wushaH'),
           'is_admin' => true,
         ]);

        Space::factory()
            ->count(20)
            ->create()
            ->each(function ($space) {
                Image::factory()->count(3)->create(['space_id' => $space->id]);
            });
    }
}
