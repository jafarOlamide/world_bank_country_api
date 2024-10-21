<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountriesController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/register', RegisterController::class)->name('register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/countries', [CountriesController::class, 'getInfo'])->name('country.info');
});
