<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $teams = Team::all();
        $team1 = $request->input('team1');
        $team2 = $request->input('team2');

        $players1 = $team1 ? Team::find($team1)?->players : [];
        $players2 = $team2 ? Team::find($team2)?->players : [];

        return view('matches.today_match', compact('teams', 'players1', 'players2', 'team1', 'team2'));
    }
}
