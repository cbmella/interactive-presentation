<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\PlayerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::resource('presentations', PresentationController::class);

Route::get('presentations/{presentation}/player/{player}', [PresentationController::class, 'player'])->name('presentations.player');
Route::get('presentations/ready/{presentation}', [PresentationController::class, 'ready'])->name('presentations.ready');

Route::resource('slides', SlideController::class);
Route::get('slides/next/{slide}', [SlideController::class, 'next'])->name('slides.next');

Route::middleware('checktoken')->group(function () {
    Route::get('players/wait', [PlayerController::class, 'wait'])->name('players.wait');
    Route::resource('players', PlayerController::class);
    Route::get('players/{player}/token/{token}', [PlayerController::class, 'generate'])->name('players.generate');
    Route::put('players/{player}', [PlayerController::class, 'next'])->name('players.next');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
