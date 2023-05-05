<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $s = fake()->randomLetter().fake()->randomLetter().fake()->randomLetter().fake()->randomLetter();
        return [
                'name' => fake()->words(2, true),
                'shortname' => $s,
                'image' => fake()->boolean() ? ('https://via.placeholder.com/400x400.png/004466?text='.$s) : "" ,
            ];
    }
}
