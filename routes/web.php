<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController1;

Route::get('/', [MovieController1::class, 'index'])->name('home');
Route::get('/theloai/{id}', [MovieController1::class, 'filterByGenre'])->name('genre.filter');
