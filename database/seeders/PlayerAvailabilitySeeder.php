<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\PlayerAvailability;

class PlayerAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Monday', 'Wednesday', 'Friday', 'Saturday', 'Sunday'];

        $timeOptions = [
            ['start' => '16:00', 'end' => '18:00'],
            ['start' => '18:00', 'end' => '21:00'],
            ['start' => '15:00', 'end' => '17:00'],
            ['start' => '07:00', 'end' => '09:00'],
            ['start' => '19:00', 'end' => '22:00'],
        ];

        $players = Player::all();

        foreach ($players as $player) {
            $availCount = rand(2, 3); // 2–3 slot per player
            $usedDays = [];

            for ($i = 0; $i < $availCount; $i++) {
                // Avoid duplicate day for same player
                do {
                    $day = $days[array_rand($days)];
                } while (in_array($day, $usedDays));
                $usedDays[] = $day;

                $time = $timeOptions[array_rand($timeOptions)];

                PlayerAvailability::create([
                    'player_id' => $player->id,
                    'day_of_week' => $day,
                    'start_time' => $time['start'],
                    'end_time' => $time['end'],
                ]);
            }
        }
    }
}
