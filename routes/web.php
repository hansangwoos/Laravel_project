<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

// 로그인 관련
Route::get("/login",[AuthController::class , 'showlogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

// 회원가입 관련
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'createUser']);

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware('auth');

