<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use App\Models\Space;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $spaces = Space::latest()->take(4)->get();
    return view('home', compact('spaces'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');
Route::get('/district/{district}', [DistrictController::class, 'show'])->name('districts.show');

Route::middleware('auth')->group(function () {
    Route::get('/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
    Route::post('/spaces', [SpaceController::class, 'store'])->name('spaces.store');
    Route::get('/spaces/{space}/edit', [SpaceController::class, 'edit'])->name('spaces.edit');
    Route::patch('/spaces/{space}', [SpaceController::class, 'update'])->name('spaces.update');
    Route::delete('/spaces/{space}', [SpaceController::class, 'delete'])->name('spaces.delete');
    Route::delete('/images/{image}', [ImageController::class, 'delete'])->name('images.delete');
});

Route::get('/spaces/{space}', [SpaceController::class, 'show'])->name('spaces.show');

Route::get('/search', [SpaceController::class, 'search'])->name('search');


require __DIR__.'/auth.php';
