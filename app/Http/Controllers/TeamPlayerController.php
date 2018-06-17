<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;
use App\Player;

class TeamPlayerController extends Controller
{

    public function index()
    {

        $teams= Team::all();
        $players= Player::all();
        return response()->json($teams, $players);
    }

    public function show($team_id, $player_id)
    {
        $teams= Team::find($team_id);
        $players= Player::find($player_id);
        return response()->json($teams, $players);
    }
}
