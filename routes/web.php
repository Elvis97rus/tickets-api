<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shows', [ShowController::class, 'index']);
Route::get('/shows/{id}', [ShowController::class, 'show']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events/{id}/book', [EventController::class, 'book']);
