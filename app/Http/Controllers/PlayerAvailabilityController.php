<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerAvailabilitiesRequest;
use App\Models\PlayerAvailability;
use Illuminate\Http\Request;
use App\Models\Player;

class PlayerAvailabilityController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Player $player)
    {
        return view('players.availabilities.create', compact('player'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerAvailabilitiesRequest $request, Player $player)
    {
        $validated = $request->validated();

        $player->availabilities()->create($validated);

        return to_route('players.show', $player)->with('success', 'Availability created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player, PlayerAvailability $availability)
    {
        $availability->delete();

        return back()->with('success', 'Availability deleted successfully.');
    }
}
