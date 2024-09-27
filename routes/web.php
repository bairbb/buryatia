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

Route::get('/spaces/{slug}', [SpaceController::class, 'show'])->name('spaces.show');

require __DIR__.'/auth.php';
