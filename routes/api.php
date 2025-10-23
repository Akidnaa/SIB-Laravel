<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/genres', [genreController::class, 'index']);
Route::post('/genres', [genreController::class, 'store']);


Route::get('/authors', [authorController::class, 'index']);
Route::post('/authors', [authorController::class, 'store']);

Route::get('/books', [bookController::class, 'index']);
Route::post('/books', [bookController::class, 'store']);