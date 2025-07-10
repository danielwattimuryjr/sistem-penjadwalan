<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Court;

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
