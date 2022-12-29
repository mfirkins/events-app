<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->randomElement(['Concert', 'Fayre', 'Conference', 'Trade Show', 'Webinar', 'Rugby Match']);
        $random_file_number = fake()->numberBetween(1,4);
        $image_path = asset("storage/images/event_defaults/$name/$random_file_number.jpg");
        return [
            'name' => $name,
            'image_path' => $image_path,
            'description' => fake()->paragraph(20),
            'time' => fake()->dateTimeThisDecade(),
            'user_id' => function () {
                return User::factory()->create();
            },
            'venue_id' => function () {
                return Venue::factory()->create();
            },
            'host' => fake()->company(),
            'cost' => fake()->numberBetween(0, 50),
            'tickets' => fake()->numberBetween(0,1000),
        ];



    }
}
