<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;
use App\Team;
use App\Player;
use App\Game;
use App\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teams = [];
        for($i = 0; $i< 10; $i++)
        {
            $t1 = \App\Models\Team::factory()->create();
            $t2 = \App\Models\Team::factory()->create();
            \App\Models\Player::factory()->create()->team()->associate($t2)->save();
            \App\Models\Player::factory()->create()->team()->associate($t1)->save();
            \App\Models\Player::factory()->create()->team()->associate($t2)->save();
            \App\Models\Player::factory()->create()->team()->associate($t1)->save();
            $g = \App\Models\Game::factory()->create();
            $g->homeTeam()->associate($t1)->save();
            $g->awayTeam()->associate($t2)->save();
            $p1 = \App\Models\Player::factory()->create();
            $p2 = \App\Models\Player::factory()->create();
            $p1->team()->associate($t1)->save();
            $p2->team()->associate($t2)->save();
            \App\Models\Event::factory()->create()->player()->associate($p1)->game()->associate($g)->save();
            \App\Models\Event::factory()->create()->player()->associate(fake()->boolean() ? $p1 : $p2)->game()->associate($g)->save();
            \App\Models\Event::factory()->create()->player()->associate($p2)->game()->associate($g)->save();
            array_push($teams, $t1);
            array_push($teams, $t2);
        }

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@szerveroldali.hu',
            'is_admin' => 1,
            'password' => '$2y$10$oT1xQg2EuiyEczBM0P/UT.nvKPV4dreZP36.xACsc3tSQONxawVgS',
         ]);
        
        for($i = 0; $i < 9; $i++)
        {
            $u = \App\Models\User::factory()->create();
            $u->teams()->attach($teams[$i]);
            $u->teams()->attach($teams[$i+1]);
        }
    }
}
