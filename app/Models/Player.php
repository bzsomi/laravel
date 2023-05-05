<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'player_id');
    }
}
