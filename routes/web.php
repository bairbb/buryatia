<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
    Route::post('/spaces', [SpaceController::class, 'store'])->name('spaces.store');
    Route::get('/spaces/{slug}/edit', [SpaceController::class, 'edit'])->name('spaces.edit');
    Route::post('/spaces/{slug}', [SpaceController::class, 'update'])->name('spaces.update');
    Route::delete('/spaces/{space}', [SpaceController::class, 'destroy'])->name('spaces.destroy');
});

Route::get('/spaces/{slug}', [SpaceController::class, 'show'])->name('spaces.show');

require __DIR__.'/auth.php';
