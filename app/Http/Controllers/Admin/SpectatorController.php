<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spectator;
use App\Models\Competition;
use App\Http\Requests\Admin\SpectatorFormRequest;

class SpectatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spectators.index', [
            'spectators' => Spectator::orderBy('last_name', 'asc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spectators.form', [
            'competitions' => Competition::all(),
            'spectator' => new Spectator(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpectatorFormRequest $request)
    {
        $spectator = Spectator::create($request->validated());
        return to_route('admin.spectator.index')->with('success', 'Le spectateur a bien ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spectator $spectator)
    {
        return view('admin.spectators.form', [
            'spectator' => $spectator,
            'competitions' => Competition::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpectatorFormRequest $request, Spectator $spectator)
    {
        $spectator->update($request->validated());
        return to_route('admin.spectator.index')->with('success', 'Le spectateur a bien ete modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spectator $spectator)
    {
        $spectator->delete();
        return to_route('admin.spectator.index')->with('success', 'Le spectateur a bien ete supprime');
    }
}
