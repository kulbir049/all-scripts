<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $teamsWithPlayers = Player::with('team')->get()->groupBy('team.name');

        return view('players.index', compact('teamsWithPlayers')); // Pass grouped data to Blade
    }


    public function create()
    {
        $teams = Team::all(); // Fetch teams for dropdown selection
        return view('players.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            //'role' => 'required|string',
            'team_id' => 'required|exists:teams,id'
        ]);

        Player::create($request->all());

        return redirect()->route('players.index')->with('success', 'Player added successfully');
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    public function edit(Player $player)
    {
        $teams = Team::all(); // Fetch teams for dropdown selection
        return view('players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string',
            //'role' => 'required|string',
            'team_id' => 'required|exists:teams,id'
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')->with('success', 'Player updated successfully');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted successfully');
    }
}
