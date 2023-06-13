<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\View\Components\GuestLayout;
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
    return redirect(route('games.index'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('games', GameController::class)
    ->only(['index']);

Route::resource('games', GameController::class)
    ->only(['store', 'create', 'destroy', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

Route::get('/games/my-games', [GameController::class, 'myGames'])->middleware(['auth', 'verified'])->name('games.myGames');

require __DIR__ . '/auth.php';
