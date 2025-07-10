<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $players = [
            ['name' => 'Namero Abiyyu Gnanim', 'position' => 'SF', 'jersey_number' => 30],
            ['name' => 'Mikle Timberty', 'position' => 'PF', 'jersey_number' => 8],
            ['name' => 'Rayyan Adibrata', 'position' => 'SG', 'jersey_number' => 6],
            ['name' => 'Nigel Chaveli', 'position' => 'PG', 'jersey_number' => 5],
            ['name' => 'Roger', 'position' => 'SG', 'jersey_number' => 4],
            ['name' => 'Rivaldo', 'position' => 'C', 'jersey_number' => 7],
            ['name' => 'Gugum Gumilar', 'position' => 'PF', 'jersey_number' => 9],
            ['name' => 'Joe Ravael', 'position' => 'C', 'jersey_number' => 12],
            ['name' => 'Muhammad Reza', 'position' => 'SF', 'jersey_number' => 10],
            ['name' => 'Samcule', 'position' => 'PG', 'jersey_number' => 11],
            ['name' => 'Rizky Ramadhan', 'position' => 'C', 'jersey_number' => 13],
            ['name' => 'Rafi Dwi Cahyo', 'position' => 'SF', 'jersey_number' => 15],
            ['name' => 'Julius', 'position' => 'SG', 'jersey_number' => 14],
            ['name' => 'Graciano Vito', 'position' => 'SG', 'jersey_number' => 16],
            ['name' => 'Awen', 'position' => 'C', 'jersey_number' => 17],
        ];

        Player::insert($players);
    }
}
