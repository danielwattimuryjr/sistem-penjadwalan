<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function openWelcomePage()
    {
        $schedules = Schedule::where('date', '>', Carbon::now())
            ->where('type', '<>', null)
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->limit(3)
            ->get();

        return view('welcome', compact('schedules'));
    }

    public function openRosterPage()
    {
        $players = Player::orderBy('name')->get([
            'name',
            'position',
            'jersey_number'
        ]);

        return view('roster', compact('players'));
    }

    public function openSchedulesPage(Request $request)
    {
        $schedules = Schedule::when(
            $request->jenis_sesi,
            fn($query, $value) =>
            $query->where('type', $value)
        )
            ->when(
                $request->year,
                fn($query, $value) => $query->whereRaw("YEAR(date) = ?", [$value]),
                fn($query) => $query->where('date', '>', Carbon::now())
            )
            ->orderByRaw('type IS NULL, type ASC')
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        $yearOptions = DB::table('schedules')
            ->selectRaw('YEAR(date) as year')
            ->distinct()
            ->get();

        return view('schedules', compact(['schedules', 'yearOptions']));
    }
}
