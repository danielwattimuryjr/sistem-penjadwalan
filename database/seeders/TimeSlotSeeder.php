<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TimeSlot;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimeSlot::insert([
            ['day_of_week' => 'Wednesday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],
            ['day_of_week' => 'Friday', 'start_time' => '15:00:00', 'end_time' => '18:00:00'],
            ['day_of_week' => 'Saturday', 'start_time' => '07:00:00', 'end_time' => '10:00:00'],
            ['day_of_week' => 'Sunday', 'start_time' => '19:00:00', 'end_time' => '22:00:00'],
        ]);
    }
}
