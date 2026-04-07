<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController3;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

Route::prefix('admin/movies')->name('admin.movies.')->group(function () {
    Route::get('/', [MovieController3::class, 'index'])->name('index');
    Route::get('/create', [MovieController3::class, 'create'])->name('create');
    Route::post('/', [MovieController3::class, 'store'])->name('store');
    Route::get('/{id}', [MovieController3::class, 'show'])->name('show');
    Route::delete('/{id}', [MovieController3::class, 'destroy'])->name('destroy');
});
