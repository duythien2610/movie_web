<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController3;

use App\Http\Controllers\MovieController1;

Route::get('/', [MovieController1::class, 'index'])->name('home');
Route::get('/theloai/{id}', [MovieController1::class, 'filterByGenre'])->name('genre.filter');
Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

// --- Phần của Người 2 (MovieController2) ---
Route::get('/timkiem', [App\Http\Controllers\MovieController2::class, 'search']);
Route::get('/phim/{id}', [App\Http\Controllers\MovieController2::class, 'show']);
Route::prefix('admin/movies')->name('admin.movies.')->group(function () {
    Route::get('/', [MovieController3::class, 'index'])->name('index');
    Route::get('/create', [MovieController3::class, 'create'])->name('create');
    Route::post('/', [MovieController3::class, 'store'])->name('store');
    Route::get('/{id}', [MovieController3::class, 'show'])->name('show');
    Route::delete('/{id}', [MovieController3::class, 'destroy'])->name('destroy');
});
