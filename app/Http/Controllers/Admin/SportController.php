<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Http\Requests\Admin\SportFormRequest;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sports.index', [
            'sports' => Sport::orderBy('name', 'asc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sports.form', [
            'sport' => new Sport(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportFormRequest $request)
    {
        $sport = Sport::create($request->validated());
        return to_route('admin.sport.index')->with('success', 'Le sport a bien ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sport $sport)
    {
        return view('admin.sports.form', [
            'sport' => $sport
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SportFormRequest $request, Sport $sport)
    {
        $sport->update($request->validated());
        return to_route('admin.sport.index')->with('success', 'Le sport a bien ete modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return to_route('admin.sport.index')->with('success', 'Le sport a bien ete supprime');
    }
}
