<?php

namespace Database\Seeders;

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
        $this->call([
            PlayerSeeder::class,
            CourtSeeder::class,
            TimeSlotSeeder::class,
            CourtAvailabilitySeeder::class,
            PlayerAvailabilitySeeder::class,
            LaratrustSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
        ])->addRole('admin');


    }
}
