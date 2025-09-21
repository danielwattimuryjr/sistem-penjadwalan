<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\PlayerAvailability;
use Illuminate\Database\Seeder;

class PlayerAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        // Slot waktu yang SAMA dengan CourtAvailabilitySeeder
        $timeSlots = [
            // Weekdays evening
            ['day' => 'Monday', 'start' => '18:00:00', 'end' => '21:00:00'],
            ['day' => 'Tuesday', 'start' => '18:00:00', 'end' => '21:00:00'],
            ['day' => 'Wednesday', 'start' => '18:00:00', 'end' => '21:00:00'],
            ['day' => 'Thursday', 'start' => '18:00:00', 'end' => '21:00:00'],
            ['day' => 'Friday', 'start' => '18:00:00', 'end' => '21:00:00'],

            // Weekend morning
            ['day' => 'Saturday', 'start' => '07:00:00', 'end' => '10:00:00'],
            ['day' => 'Sunday', 'start' => '07:00:00', 'end' => '10:00:00'],

            // Weekend afternoon
            ['day' => 'Saturday', 'start' => '15:00:00', 'end' => '18:00:00'],
            ['day' => 'Sunday', 'start' => '15:00:00', 'end' => '18:00:00'],

            // Weekend evening
            ['day' => 'Saturday', 'start' => '19:00:00', 'end' => '22:00:00'],
            ['day' => 'Sunday', 'start' => '19:00:00', 'end' => '22:00:00'],
        ];

        $players = Player::all();

        // Distribusi strategis untuk memastikan coverage setiap hari
        $playerDistribution = [
            // Monday evening - 6 players
            'Monday_18:00:00' => [1, 2, 3, 7, 9, 12],

            // Tuesday evening - 6 players
            'Tuesday_18:00:00' => [2, 4, 5, 8, 10, 13],

            // Wednesday evening - 6 players
            'Wednesday_18:00:00' => [1, 4, 6, 9, 11, 14],

            // Thursday evening - 6 players
            'Thursday_18:00:00' => [3, 5, 6, 8, 12, 15],

            // Friday evening - 6 players
            'Friday_18:00:00' => [1, 7, 10, 11, 13, 14],

            // Saturday morning - 5 players
            'Saturday_07:00:00' => [2, 5, 7, 9, 15],

            // Saturday afternoon - 5 players
            'Saturday_15:00:00' => [3, 6, 8, 11, 12],

            // Saturday evening - 5 players
            'Saturday_19:00:00' => [4, 10, 13, 14, 1],

            // Sunday morning - 5 players
            'Sunday_07:00:00' => [2, 4, 6, 9, 15],

            // Sunday afternoon - 5 players
            'Sunday_15:00:00' => [3, 7, 8, 12, 1],

            // Sunday evening - 5 players
            'Sunday_19:00:00' => [5, 10, 11, 13, 14],
        ];

        // Clear existing data
        PlayerAvailability::truncate();

        // Create availabilities based on strategic distribution
        foreach ($playerDistribution as $slotKey => $playerIds) {
            [$day, $startTime] = explode('_', $slotKey);

            // Find the corresponding end time
            $endTime = null;
            foreach ($timeSlots as $slot) {
                if ($slot['day'] === $day && $slot['start'] === $startTime) {
                    $endTime = $slot['end'];
                    break;
                }
            }

            if ($endTime) {
                foreach ($playerIds as $playerId) {
                    // Make sure player exists
                    if ($playerId <= $players->count()) {
                        PlayerAvailability::create([
                            'player_id' => $playerId,
                            'day_of_week' => $day,
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                        ]);
                    }
                }
            }
        }

        // Add some extra random availabilities to create more flexibility
        foreach ($players as $player) {
            $currentSlots = PlayerAvailability::where('player_id', $player->id)->count();

            // Ensure each player has at least 3-4 slots
            if ($currentSlots < 3) {
                $additionalSlots = 4 - $currentSlots;
                $availableSlots = collect($timeSlots)->shuffle()->take($additionalSlots);

                foreach ($availableSlots as $slot) {
                    // Check if player already has this slot
                    $exists = PlayerAvailability::where('player_id', $player->id)
                        ->where('day_of_week', $slot['day'])
                        ->where('start_time', $slot['start'])
                        ->exists();

                    if (! $exists) {
                        PlayerAvailability::create([
                            'player_id' => $player->id,
                            'day_of_week' => $slot['day'],
                            'start_time' => $slot['start'],
                            'end_time' => $slot['end'],
                        ]);
                    }
                }
            }
        }
    }
}
