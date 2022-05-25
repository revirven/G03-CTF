<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Challenge;
use App\Models\Solve;
use App\Models\User;

class ChallengeController extends Controller
{
    public function show() {
        $challenges = Challenge::select('id', 'name', 'descript', 'hint', 'file', 'category', 'score')->get();
        
        $user = User::where('email', session()->get('email'))->first();
        $solves = $user->solves()->select("challenge_id")->get();

        $solved = array();

        foreach($solves as $solve) {
            array_push($solved, $solve->challenge_id);
        }
        
        if (session()->has('chall_id')) {
            $msg = array('note' => session()->get('note'), 'chall_id' => session()->get('chall_id'), 'validated' => session()->get('validated'));
            return view('/challenges', compact('challenges', 'msg', 'solved'));
        }

        return view('/challenges', compact('challenges', 'solved'));
    }

    public function submit(Request $request) {
        $flag = $request->input('flag');
        $chall_id = $request->input('challenge_id');

        $chall = Challenge::findOrFail($chall_id);
        
        $validated = Hash::check($flag, $chall->flag);

        if ($validated) {
            // Insert into solves table if not solved
            $user = User::where('email', session()->get('email'))->first();
            
            $solved = Solve::where('user_id', $user->id)->where('challenge_id', $chall->id)->first();

            if(is_null($solved)) {
                $solve = new Solve();
                $solve->user()->associate($user);
                $solve->challenge()->associate($chall);
                $solve->save();
                
                // Update profiles table
                $profile = $user->profile;
    
                switch($chall->category) {
                    case 'web':
                        $profile->web += $chall->score;
                        break;
                    case 'pwn':
                        $profile->pwn += $chall->score;
                        break;
                    case 'rev':
                        $profile->rev += $chall->score;
                        break;
                    case 'frs':
                        $profile->frs += $chall->score;
                        break;
                }
    
                $profile->save();
                
                return redirect()->intended('/challenges')->with(
                    ['note' => 'Great job. You have earned '.$chall->score.' points.',
                    'chall_id' => $chall->id,
                    'validated' => true]
                );
            }
            
            return redirect()->intended('/challenges')->with(
                ['note' => 'Great job. But you have already validated this challenge.',
                'chall_id' => $chall->id,
                'validated' => true]
            );    
        }
        
        return redirect()->intended('/challenges')->with(
            ['note' => 'Incorrect flag. Try harder.',
            'chall_id' => $chall->id,
            'validated' => false]
        );
    }

    public function fileDownload($file) {
        dd($file);
        return Storage::download($file);
    }
}
