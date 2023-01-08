<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Profile;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // no factory is needed for cateogories as there is a finite amount of categories
        $category_names = ['Free Events', 'Musical Events', 'Professional Talks', '18+ Events', 'Online Events', 'Sports'];

        foreach($category_names as $name){
            $category = new Category;
            $category->profile_id = Profile::factory()->create()->id;
            $category->name = $name;
            $category->save();
        }

    }
}

