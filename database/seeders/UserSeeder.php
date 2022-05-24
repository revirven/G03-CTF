<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->email = Str::random(6).'@email.com';
        $user->username = Str::random(6);
        $user->password = Hash::make('Password1');
        $user->admin = false;

        $user->save();

        $profile = new Profile();
        $profile->web = rand(100, 1000);
        $profile->pwn = rand(100, 1000);
        $profile->rev = rand(100, 1000);
        $profile->frs = rand(100, 1000);

        $user->profile()->save($profile);
    }
}
