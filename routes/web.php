<?php

use App\Http\Controllers\ForwardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forward/{forward}', ForwardController::class)
    ->name('forward');
