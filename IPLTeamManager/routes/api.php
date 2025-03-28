<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;

Route::apiResource('teams', TeamController::class);
Route::apiResource('players', PlayerController::class);

