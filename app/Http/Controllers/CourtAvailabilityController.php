<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourtAvailabilitiesRequest;
use App\Models\CourtAvailability;
use Illuminate\Http\Request;
use App\Models\Court;

class CourtAvailabilityController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Court $court)
    {
        return view('courts.availabilities.create', compact('court'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourtAvailabilitiesRequest $request, Court $court)
    {
        $validated = $request->validated();

        $court->availabilities()->create($validated);

        return to_route('courts.show', $court)->with('success', 'Availability created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Court $court, CourtAvailability $availability)
    {
        $availability->delete();

        return back()->with('success', 'Availability deleted successfully.');
    }
}
