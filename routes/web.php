<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Shows\EpisodeController;
use App\Http\Controllers\Shows\SeasonController;
use App\Http\Controllers\Shows\ShowController;
use App\Http\Controllers\Shows\ToggleEpisodeWatchedController;
use App\Http\Controllers\Shows\ToggleShowOnWatchlistController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Watchlist\ChangeWatchlistVisibilityController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/shows/{show}', ShowController::class)->name('show');
    Route::post('/shows/{show}/watchlist', ToggleShowOnWatchlistController::class)->name('show.watchlist');
    Route::get('/shows/season/{season}', SeasonController::class)->name('show.season');
    Route::get('/shows/episode/{episode}', EpisodeController::class)->name('show.episode');
    Route::post('/shows/episode/{episode}/watched', ToggleEpisodeWatchedController::class)->name('show.episode.watched');
    Route::put('/watchlist/{watchlist}/visibility', ChangeWatchlistVisibilityController::class)->name('watchlist.visibility');
    Route::get('/user/{user}', UserProfileController::class)->name('user.profile');
});

// Authentication Routes - no need to modify these
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
