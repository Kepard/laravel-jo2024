<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spectator;
use App\Models\Competition;
use App\Models\Sport;
use App\Http\Requests\ReservationFormRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $competitions = Competition::all();
        $sports = Sport::all();
        $spectator = new Spectator();
        return view('reservation', ['competitions' => $competitions, 'sports' => $sports, 'spectator' => $spectator]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationFormRequest $request)
    {   
        // Récupérer les données validées du formulaire
        $data = $request->validated();

        foreach ($data['competitions'] as $competitionId) {
            foreach ($data['first_name'] as $index => $firstName) {
                Spectator::create([
                    'competition_id' => $competitionId,
                    'first_name' => $data['first_name'][$index],
                    'last_name' => $data['last_name'][$index],
                    'phone_number' => $data['phone_number'][0],
                    'email' => $data['email'][0],
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Reservation effectuée avec success.');
    }

}
