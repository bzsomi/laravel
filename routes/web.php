<?php

use Illuminate\Support\Facades\Route;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;

use App\Http\Controllers\GameController;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('index');
});

Route::resource('/games', GameController::class);

Route::resource('/events', EventController::class);

/*

Route::get('/games', function () {
    return view('posts.index',
    [
        'games' => Game::all()->sortBy('start')->all(),
        'teams' => Team::all(),
        'users' => User::all()
    ]);
});

Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::get('/posts/x', function () {
    return view('posts.show');
});

Route::get('/posts/x/edit', function () {
    return view('posts.edit');
});

// -----------------------------------------

Route::get('/categories/create', function () {
    return view('categories.create');
});

Route::get('/categories/x', function () {
    return view('categories.show');
});

*/

// -----------------------------------------

Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

