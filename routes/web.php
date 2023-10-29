<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RunController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('flashcards.home', ['sets' => SetController::getAllSetsForCurrentUser()]);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/sets/add', [SetController::class, 'add'])->middleware(['auth', 'verified', 'owner'])->name('addset');

Route::post('/sets/add', [SetController::class, 'store'])->middleware(['auth', 'verified', 'owner'])->name('addset.post');

Route::get('/sets/{set_id}', [SetController::class, 'show'])->middleware(['auth', 'verified', 'owner' ]);

Route::get('/sets/{set_id}/edit', [SetController::class, 'update'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/delete', [SetController::class, 'destroy'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/cards', [CardController::class, 'show'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/cards/add', [CardController::class, 'add'])->middleware(['auth', 'verified', 'owner']);

Route::post('/sets/{set_id}/cards/add', [CardController::class, 'store'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/cards/{card_id}', [CardController::class, 'update'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/cards/{card_id}/delete', [CardController::class, 'destroy'])->middleware(['auth', 'verified', 'owner']);

Route::get('/sets/{set_id}/new_run', [SetController::class, 'add_run'])->middleware(['auth', 'verified', 'owner'])->name('newrun');

Route::post('/runs/add', [RunController::class, 'store'])->middleware(['auth', 'verified'])->name('newrun.post');

Route::get('/runs/{run_id}/play', [RunController::class, 'play'])->middleware(['auth', 'verified', 'owner'])->name('run.play');

Route::post('/runs/{run_id}/play', [RunController::class, 'check'])->middleware(['auth', 'verified', 'owner'])->name('run.check');

Route::get('/runs/{run_id}/stop', [RunController::class, 'stop'])->middleware(['auth', 'verified', 'owner'])->name('run.stop');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
