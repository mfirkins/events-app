<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->paragraph(1),
            'user_id' => function () {
                return User::factory()->create(); //could be changed to random row from user table
            },
            'event_id' => function () {
                return Event::inRandomOrder()->first(); //gets a random event from already created events to assign comment to
            },
            'likes' => fake()->randomNumber(2, false),
        ];
    }
}
