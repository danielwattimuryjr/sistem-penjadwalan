<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class GuestController extends Controller
{
    public function openWelcomePage() {
        return view('welcome');
    }

    public function openRosterPage() {
        $players = Player::orderBy('name')->get([
            'name',
            'position',
            'jersey_number'
        ]);

        return view('roster', compact('players'));
    }

    public function openSchedulesPage() {
        return view('schedules');
    }
}
