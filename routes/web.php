<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\GenreController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/zanri', function () {
    return view('zanri'); 
})->name('zanri'); 

Route::get('/song', function () {
    return view('song');
})->middleware(['auth', 'verified'])->name('song');



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

Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
Route::get('/genre/{genre}/edit', [GenreController::class, 'edit'])->name('genre.edit');
Route::put('/genre/{genre}/update', [GenreController::class, 'update'])->name('genre.update');
Route::delete('/genre/{genre}/destroy', [GenreController::class, 'destroy'])->name('genre.destroy');

Route::resource('genres', GenreController::class);

require __DIR__.'/auth.php';
