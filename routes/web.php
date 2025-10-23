<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/genres', [genreController::class, 'index']);
Route::get('/authors', [authorController::class, 'index']);
Route::get('/books', [bookController::class, 'index']);