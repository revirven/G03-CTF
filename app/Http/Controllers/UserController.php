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

    public function authenticate() {
        
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
}
