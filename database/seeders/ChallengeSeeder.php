<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Challenge;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = array('web', 'pwn', 'rev', 'frs');

        $challenge = new Challenge();

        $challenge->name = Str::random(10);
        $challenge->descript = Str::random(50);
        $challenge->hint = Str::random(50);
        $challenge->file = Str::random(20);
        $challenge->category = $cat[rand(0, 3)];
        $challenge->score = rand(100, 1000);
        $challenge->flag = Hash::make('g03_ctf{fake_flag}');

        $challenge->save();
    }
}
