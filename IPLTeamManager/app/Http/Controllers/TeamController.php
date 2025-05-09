<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('players')->get();
        return view('teams.index', compact('teams')); // Return Blade view
    }

    public function create()
    {
        return view('teams.create'); // Return Blade view for form
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        Team::create($request->all());

        return redirect()->route('teams.index')->with('success', 'Team created successfully');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team')); // Return Blade view
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team')); // Return Blade view for editing
    }

    public function update(Request $request, Team $team)
    {
        $request->validate(['name' => 'required|string']);
        
        $team->update($request->all());

        return redirect()->route('teams.index')->with('success', 'Team updated successfully');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully');
    }
}
