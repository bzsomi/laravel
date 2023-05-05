<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function gamesHome()
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    public function gamesAway()
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
