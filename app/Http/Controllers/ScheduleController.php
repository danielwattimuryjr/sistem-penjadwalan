<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledSession;
use Illuminate\Support\Facades\Http;
use App\Models\Player;
use App\Models\Court;
use App\Models\TimeSlot;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = ScheduledSession::orderBy('time_slot_id')->get();
        return view('penjadwalan.index', compact('schedules'));
    }

    public function generate()
    {
        $players = Player::with('availabilities')->get()->map(function ($player) {
            return [
                'id' => $player->id,
                'name' => $player->name,
                'availabilities' => $player->availabilities->map(function ($a) {
                    return [
                        'day' => $a->day_of_week,
                        'start' => $a->start_time,
                        'end' => $a->end_time,
                    ];
                }),
            ];
        });

        $courts = Court::with('availabilities')->get()->flatMap(function ($court) {
            return $court->availabilities->map(function ($a) use ($court) {
                return [
                    'court_id' => $court->id,
                    'day' => $a->day_of_week,
                    'start' => $a->start_time,
                    'end' => $a->end_time,
                ];
            });
        });

        $timeSlots = TimeSlot::all()->map(fn($slot) => [
            'id' => $slot->id,
            'day' => $slot->day_of_week,
            'start' => $slot->start_time,
            'end' => $slot->end_time,
        ]);

        $courtList = Court::all()->map(fn($c) => [
            'id' => $c->id,
            'name' => $c->name,
            'location' => $c->location,
        ]);

        $response = Http::post(env('PYTHON_API_URL') . '/solve', [
            'players' => $players,
            'court_availabilities' => $courts,
            'time_slots' => $timeSlots,
            'courts' => $courtList,
        ]);

        $result = $response->json();

        return $result;
    }
}
