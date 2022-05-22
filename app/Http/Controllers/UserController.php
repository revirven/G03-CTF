<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

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

    public function challenges() {
        return view('/challenges');
    }

    public function profile () {
        
        return view('/profile');
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            
            return redirect()->route('home.index');
        }

        return redirect()->back()->withErrors(['fail' => 'Incorrect email or password.']);
    }
    
    public function add(RegisterRequest $request) {
        $request->validated();

        $user = new User();
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('re_password'));
        
        $user->save();

        return redirect()->route('user.login')->withErrors(['success' => 'Successfully registered. You can now login.']);
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
 
        return redirect()->route('home.index');
    }
}
