<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;
use App\Models\Profile;
use App\Models\Challenge;

// Format data
use Illuminate\Support\Str;

// Password hashing
use Illuminate\Support\Facades\Hash;

// Raw query
use Illuminate\Support\Facades\DB;

// User authentication
use Illuminate\Support\Facades\Auth;

// Sign Up Request handle
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function login() {
        return view('/user/login');
    }

    public function register() {
        return view('/user/register');
    }

    public function profile () {
        $user = User::where('email', session()->get('email'))->first();
        $profile = $user->profile->select('id', 'web', 'pwn', 'rev', 'frs', 'total')->first();

        $username = Str::upper($user->username);
        $scores = array($profile->web, $profile->pwn, $profile->rev, $profile->frs);
        $totalScore = $profile->total;

        $rank = $this->getRank($profile->id);
        $str_rank = $this->formatRank($rank);

        return view('/user/profile', compact('scores', 'totalScore', 'str_rank', 'username'));
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('email', $credentials['email']);

            return redirect()->route('home.index');
        }

        return redirect()->back()->withErrors(['fail' => 'Incorrect email or password.']);
    }
    
    public function add(RegisterRequest $request) {
        $credentials = $request->validated();

        $user = new User();
        $user->email = $credentials['email'];
        $user->username = $credentials['username'];
        $user->password = Hash::make($credentials['re_password']);
        $user->admin = false;
        
        $user->save();

        $profile = new Profile();
        $user->profile()->save($profile);

        return redirect()->route('user.login')->withErrors(['success' => 'Successfully registered. You can now login.']);
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
 
        return redirect()->route('home.index');
    }

    // Data handling
    private function getRank(int $id) {
        $rankTable = Profile::select('id', 'total', DB::raw('rank() over (order by total desc) as ranking'))->get();
        $rank = 0;
        
        foreach($rankTable as $entry) {
            if ($entry->id === $id) {
                $rank = $entry->ranking;
            }
        }

        return $rank;
    }

    private function formatRank(int $rank) {
        $str_rank = strval($rank);

        if (Str::endsWith($str_rank, ['11', '12', '13'])) {
            $str_rank .= 'th';
        }
        elseif (Str::endsWith($str_rank, '1')) {
            $str_rank .= 'st';
        }
        elseif (Str::endsWith($str_rank, '2')) {
            $str_rank .= 'nd';
        }
        elseif (Str::endsWith($str_rank, '3')) {
            $str_rank .= 'rd';
        }
        else {
            $str_rank .= 'th';
        }

        return $str_rank;
    }
}
