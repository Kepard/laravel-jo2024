<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Sport;
use App\Models\Location;
use App\Http\Requests\Admin\CompetitionFormRequest;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.competitions.index', [
            'competitions' => Competition::orderBy('day', 'asc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.competitions.form', [
            'competition' => new Competition(),
            'sports' => Sport::all(),
            'locations' => Location::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionFormRequest $request)
    {
        $competition = Competition::create($request->validated());
        return to_route('admin.competition.index')->with('success', 'La competition a bien ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        return view('admin.competitions.form', [
            'competition' => $competition,
            'sports' => Sport::all(),
            'locations' => Location::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetitionFormRequest $request, Competition $competition)
    {
        $competition->update($request->validated());
        return to_route('admin.competition.index')->with('success', 'La competition a bien ete modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();
        return to_route('admin.competition.index')->with('success', 'La competition a bien ete supprime');
    }
}
