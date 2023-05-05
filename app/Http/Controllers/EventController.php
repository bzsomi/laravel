<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $date = date('Y-m-d H:i:s');
        $G = Game::all()->where('finished','=','0')
        ->filter(function ($item) use ($date) {
            return (data_get($item, 'start') < $date);
        });
        $t = [];
        foreach($G as $g)
        {
            if(!in_array($g->homeTeam->id, $t))
            { array_push($t, $g->homeTeam->id); }
            if(!in_array($g->awayTeam->id, $t))
            { array_push($t, $g->awayTeam->id); }
        }
        $P = Player::all()->whereIn('team_id', $t)->sortBy([
            ['team_id', 'asc'],
            ['number', 'asc'],
          ]);
          $t = [];
        foreach($P as $p)
        {
            if(!in_array($p->name, $t))
            { array_push($t, $p->name); }
        }
        return view('events.create',
        [
        'players' => $P,
        'games' => $G,
        'x' => $t
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $G = Game::all()->where('finished','=','0')
        ->filter(function ($item) use ($date) {
            return (data_get($item, 'start') < $date);
        });
        $t = [];
        foreach($G as $g)
        {
            if(!in_array($g->homeTeam->id, $t))
            { array_push($t, $g->homeTeam->id); }
            if(!in_array($g->awayTeam->id, $t))
            { array_push($t, $g->awayTeam->id); }
        }
        $P = Player::all()->whereIn('team_id', $t)->all();
        $t = [];
        foreach($P as $p)
        {
            if(!in_array($p->name, $t))
            { array_push($t, $p->name); }
        }

        $validated = $request->validate([
            'player' =>
            [
                'required',
                Rule::in($t)
            ],
            'minute' => 'required|integer|between:1,90',
            'type' =>
            [
                'required',
                Rule::in(['gól', 'öngól', 'sárga lap', 'piros lap'])
            ],
        ]);

        $name = $request->input()['player'];
        $p = Player::where('name', '=', $name)->get();
        
        $id = $p[0]->team_id;
        $g = $G->filter(function ($item) use ($id) {
            return (data_get($item, 'home_team_id') == $id) || (data_get($item, 'away_team_id') == $id);
        });

        $indG = 0;
        $indP = 0;
        foreach($g as $k => $v) { $indG = $k; }
        foreach($p as $k => $v) { $indP = $k; }
        
        Event::factory()->create([
            'type' => $request->input()['type'],
            'minute' => $request->input()['minute'],
            'game_id' => $g[$indG],
            'player_id' => $p[$indP]->id,
        ]);
 
        // The blog post is valid...
        Session::flash('event_created');
        return redirect()->route('events.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
