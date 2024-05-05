<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Requests\Admin\LocationFormRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.locations.index', [
            'locations' => Location::orderBy('name', 'asc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locations.form', [
            'location' => new Location(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationFormRequest $request)
    {
        $location = Location::create($request->validated());
        return to_route('admin.location.index')->with('success', 'Le lieu a bien ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('admin.locations.form', [
            'location' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationFormRequest $request, Location $location)
    {
        $location->update($request->validated());
        return to_route('admin.location.index')->with('success', 'Le lieu a bien ete modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return to_route('admin.location.index')->with('success', 'Le lieu a bien ete supprime');
    }
}
