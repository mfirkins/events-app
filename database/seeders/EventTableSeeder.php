<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::factory()->count(50)->for(User::factory()->create())->create()->each(function ($event) {

            $categories = Category::inRandomOrder()->get();
            // select a random number of categories then assign a random category to an event
            for($i = 0; $i < rand(1,6); ++$i){
                $event->categories()->attach($categories->first());
                $categories->forget($categories->keys()->first()); //remove category if already used
            }
            
        });



    }
}
