<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CallController;
use App\Models\Client;
use App\Models\Call;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

  Route::inertia('/', 'Home')->name('home');

  Route::inertia('/client', 'ClientRegister')->name('client');
  Route::post('/client', [ClientController::class, 'register']);

  Route::inertia('/call', 'CallRegister', ['clients' => Client::all(['cliente_id']), 'count' => Client::all(['cliente_id'])->count()])->name('call');
  Route::post('/call', [CallController::class, 'register']);

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware('guest')->group(function () {

  Route::inertia('/register', 'Auth/Register')->name('register');
  Route::post('/register', [AuthController::class, 'register']);

  Route::inertia('/login','Auth/Login')->name('login');
  Route::post('/login', [AuthController::class, 'login']);
    
});
