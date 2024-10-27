<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//manis taisitais
Route::get('/song', [SongController::class, 'index'])->name('song.index');
Route::get('/song/create', [SongController::class, 'create'])->name('song.create');
Route::post('/song', [SongController::class, 'store'])->name('song.store');
Route::get('/song/{song}/edit', [SongController::class, 'edit'])->name('song.edit');
Route::put('/song/{song}/update', [SongController::class, 'update'])->name('song.update');
Route::delete('/song/{song}/destroy', [SongController::class, 'destroy'])->name('song.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
