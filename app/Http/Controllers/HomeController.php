<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Profile;

class HomeController extends Controller
{
    public function home() {
        return view('/index');
    }

    public function about() {
        return view('about');
    }

    public function instruction() {
        return view('/instructions');
    }

    public function hackerboard() {
        return view('/hackerboard');
    }
}