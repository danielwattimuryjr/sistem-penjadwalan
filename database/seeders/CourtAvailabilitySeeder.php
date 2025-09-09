<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Court;
use App\Models\CourtAvailability;

class CourtAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        $courts = Court::all();

        // Slot yang lebih lengkap dan konsisten
        $slots = [
            // Weekdays evening slots
            ['day_of_week' => 'Monday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],
            ['day_of_week' => 'Tuesday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],
            ['day_of_week' => 'Wednesday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],
            ['day_of_week' => 'Thursday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],
            ['day_of_week' => 'Friday', 'start_time' => '18:00:00', 'end_time' => '21:00:00'],

            // Weekend morning slots
            ['day_of_week' => 'Saturday', 'start_time' => '07:00:00', 'end_time' => '10:00:00'],
            ['day_of_week' => 'Sunday', 'start_time' => '07:00:00', 'end_time' => '10:00:00'],

            // Weekend afternoon slots
            ['day_of_week' => 'Saturday', 'start_time' => '15:00:00', 'end_time' => '18:00:00'],
            ['day_of_week' => 'Sunday', 'start_time' => '15:00:00', 'end_time' => '18:00:00'],

            // Weekend evening slots
            ['day_of_week' => 'Saturday', 'start_time' => '19:00:00', 'end_time' => '22:00:00'],
            ['day_of_week' => 'Sunday', 'start_time' => '19:00:00', 'end_time' => '22:00:00'],
        ];

        foreach ($courts as $court) {
            foreach ($slots as $slot) {
                CourtAvailability::create([
                    'court_id' => $court->id,
                    'day_of_week' => $slot['day_of_week'],
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                ]);
            }
        }
    }
}