<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    var $past = true;
    var $present = true;
    
    public function definition(): array
    {
        global $past;
        global $present;
        if($past)
        {
            $past = false;
            return [
                'start' => fake()->dateTimeBetween('-1 month', '-1 day'),
                'finished' => true,
            ];
        }
        elseif($present)
        {
            $present = false;
            return [
                'start' => fake()->dateTimeBetween('0 day', '0 minute'),
            ]; 
        }
        else
        {
            $past = true;
            $present = true;
            return [
                'start' => fake()->dateTimeBetween('1 day', '1 week'),
            ];
        }
    }
}
