<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AnswerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('presentations/{presentation}/video/player/{player}', [PresentationController::class, 'video'])->name('presentations.video');
Route::get('presentations/qr', [PresentationController::class, 'qr'])->name('presentations.qr');
Route::get('presentations/ready', [PresentationController::class, 'ready'])->name('presentations.ready');
Route::resource('presentations', PresentationController::class);

Route::resource('slides', SlideController::class);
Route::get('slides/next/{slide}', [SlideController::class, 'next'])->name('slides.next');

Route::middleware('checktoken')->group(function () {
    Route::get('players/wait', [PlayerController::class, 'wait'])->name('players.wait');
    Route::resource('players', PlayerController::class);
    Route::get('players/generate/{token}', [PlayerController::class, 'generate'])->name('players.generate');
    Route::put('players/{player}', [PlayerController::class, 'next'])->name('players.next');
    Route::get('slides/active/{slide}', [SlideController::class, 'active'])->name('slides.active');
    Route::post('progress', [ProgressController::class, 'store'])->name('progress.store');
    Route::get('answers/correct/{answer}', [AnswerController::class, 'correct'])->name('answer.correct');
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
