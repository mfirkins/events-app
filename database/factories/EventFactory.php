<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Profile;


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
        switch($name){
            case ($name == 'Concert'):
                $image_path = "1.jpg";
                break;
            
            case ($name == 'Fayre'):
                $image_path = "2.jpg";
                break;
            
            case ($name == 'Conference'):
                $image_path = "3.jpg";
                break;
            
            case ($name == 'Trade Show'):
                $image_path = "5.jpg";
                break;
            
            case ($name == 'Webinar'):
                $image_path = "6.jpg";
                break;
            
            case ($name == 'Rugby Match'):
                $image_path = "4.jpg";
                break;
            
        }

        return [
            'name' => $name,
            'image_name' => $image_path,
            'description' => fake()->paragraph(20),
            'time' => fake()->dateTimeThisDecade(),
            'profile_id' => function () {
                return Profile::factory()->create();
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
