<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = [];
        $date = date('Y-m-d H:i:s');
        $id = 0;
        $goals = [0,0];
        $teams = [0,0];
        $save = false;
        $E = Event::all()->sortBy([
            ['game_id', 'asc'],
            ['minute', 'asc'],
        ]);
        foreach($E as $e)
        {
            if(strtotime($date) > strtotime($e->game->start))
            {
                if($id != $e->game->id)
                {
                    if($save) { $all[$id] = $goals; }
                    $save = true;
                    $id = $e->game->id;
                    $goals = [0,0];
                    $teams = [$e->game->home_team_id, $e->game->away_team_id];
                    
                }
                if(floor((strtotime($date)-strtotime($e->game->start))/60) <= $e->minute)
                {
                    if($e->type == "gól")
                    {
                        if($e->player->team_id == $teams[0]) { $goals[0] = $goals[0] + 1; }
                        else if($e->player->team_id == $teams[1]) { $goals[1] = $goals[1] + 1; }
                    }
                    else if($e->type == "öngól")
                    {
                        if($e->player->id == $teams[0]) { $goals[1] = $goals[1] + 1; }
                        else if($e->player->id == $teams[1]) { $goals[0] = $goals[0] + 1; }
                    }
                }
            }
        }
        return view('posts.index',
        [
            'games' => Game::all()->sortBy('start')->all(),
            'teams' => Team::all(),
            'users' => User::all(),
            'date' => $date,
            'goals' => $all,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('posts.show',
        [
            'game' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
