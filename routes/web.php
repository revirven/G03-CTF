<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/instruct', [HomeController::class, 'instruction'])->name('home.instruct');
Route::get('/hackerboard', [HomeController::class, 'hackerboard'])->name('home.hackerboard');

// User
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    Route::get('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/login', [UserController::class, 'authenticate'])->name('user.auth');
    Route::post('/register', [UserController::class, 'add'])->name('user.add');
});

Route::middleware('auth')->group(function () {
    Route::get('/challenges', [ChallengeController::class, 'show'])->name('chall.show');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/challenges', [ChallengeController::class, 'submit'])->name('chall.submit');
    Route::post('/profile', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/challenges/download', [ChallengeController::class, 'fileDownload'])->name('chall.download');
});

URL::forceScheme('https');