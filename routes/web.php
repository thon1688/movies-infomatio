<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TVShowController;
use App\Http\Controllers\WebSeriesController;
use App\Http\Controllers\SearchController;

// Home route
Route::get('/', [MovieController::class, 'index'])->name('home');

// Movie routes
Route::get('/movies', [MovieController::class, 'movies'])->name('movies'); // Changed from movies.index
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// TV Show routes
Route::get('/tv-shows', [TVShowController::class, 'index'])->name('tv-shows');
Route::get('/tv-shows/{id}', [TVShowController::class, 'show'])->name('tv-shows.show');

// Web Series routes
Route::get('/web-series', [WebSeriesController::class, 'index'])->name('web-series');
Route::get('/web-series/{id}', [WebSeriesController::class, 'show'])->name('web-series.show');

// Search route
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Auth routes
Auth::routes();
