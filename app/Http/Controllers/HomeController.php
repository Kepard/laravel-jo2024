<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Sport;
use App\Models\Location;
use App\Models\Spectator;

class HomeController extends Controller
{
    public function index () {
        $competitions = Competition::all();
        $sports = Sport::all();
        return view('home', ['competitions' => $competitions, 'sports' => $sports]);
    }
}
