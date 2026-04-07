<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

// --- Phần của Người 2 (MovieController2) ---
Route::get('/timkiem', [App\Http\Controllers\MovieController2::class, 'search']);
Route::get('/phim/{id}', [App\Http\Controllers\MovieController2::class, 'show']);
