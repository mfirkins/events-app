<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile;
        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@superevent.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('adminpassword');
        $user->remember_token = Str::random(10);
        $user->assignRole('Admin');
        $user->save();
        $profile = new Profile;
        $profile->image_name = "default.png";
        $profile->user_id = $user->id;
        $profile->save();
    }
}