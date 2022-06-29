<?php

use Illuminate\Support\Facades\Route;
use Pterodactyl\Http\Controllers\Auth\RegisterController;
use Pterodactyl\Http\Controllers\Auth\LoginController;


Route::group(['middleware' => 'guest'], function () {

	Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
	Route::post('/register/user', [RegisterController::class, 'register'])->name('auth.register.url');
});