<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\HomeController;

//Route::view('/', 'home');
Route::get('/', [HomeController::class, 'index']);
Route::view('/contact', 'contact');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
