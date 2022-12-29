<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $suffix = fake()->randomElement(['Arena', 'Hall', 'Stadium', 'Centre', 'Park']);
        $city = fake()->city();
        $name = "$city $suffix";
        $random_file_number = fake()->numberBetween(1,4);
        $image_name = $random_file_number . ".jpg";

        return [
            'name' => $name,
            'description' => fake()->paragraph(20),
            'city' => $city,
            'image_name' => $image_name,
            'user_id' => function () {
                return User::factory()->create();
            },
            'longitude' => fake()->longitude($min = -180, $max = 180),
            'latitude' => fake()->latitude($min = -90, $max = 90),
            'accessible' => fake()->boolean(),
        ];
    }
}