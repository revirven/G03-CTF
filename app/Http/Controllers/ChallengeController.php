<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Challenge;

class ChallengeController extends Controller
{
    public function show() {
        $challenges = Challenge::select('id', 'name', 'hint', 'file', 'category', 'score')->get();

        return view('/challenges', compact('challenges'));
    }
}
