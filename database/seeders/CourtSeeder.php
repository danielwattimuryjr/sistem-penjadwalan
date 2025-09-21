<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Court::insert([
            ['name' => 'Maco Basketball Court', 'location' => 'Jakarta'],
            ['name' => 'GBK', 'location' => 'Jakarta'],
            ['name' => 'Gym', 'location' => 'Jakarta'],
        ]);
    }
}
