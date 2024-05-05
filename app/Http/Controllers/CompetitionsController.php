<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Location;
use App\Models\Sport;

class CompetitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Competition::query();

    if ($request->filled('date')) {
        $query->whereDate('day', $request->date);
    }
    if ($request->filled('location_id')) {
        $query->where('location_id', $request->location_id);
    }
    if ($request->filled('sport_id')) {
        $query->where('sport_id', $request->sport_id);
    }

    $competitions = $query->get();
    $locations = Location::all();
    $sports = Sport::all();

    return view('competitions', ['competitions' => $competitions , 'locations' => $locations, 'sports' => $sports]);
}

}
