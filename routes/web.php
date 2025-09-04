<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LunchBreakController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;


/**
 * new Route 구성 2025-09-03
 */

// 미들웨어 그룹으로 묶어서 사용하기
// 인증이 필요하고 점심시간을 체크해야하는 페이지들끼리 middleware group 화
Route::middleware(['auth','LunchCheck'])->group(function(){
    Route::get('/dashboard',[ProductsController::class,'index'])->name('dashboard')->middleware('auth');
});

// 인증만 필요한 페이지
Route::middleware('auth')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/logout',[AuthController::class,'logout']);

});

// 인증이 필요없는 페이지 구성

Route::get('/', function () {

    if(Auth::check()){
        return redirect(route('dashboard'));
    }else {
        return view('auth.login');
    }

});

// 로그인 관련
Route::get("/login",[AuthController::class , 'showlogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

// 회원가입 관련
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'createUser']);

// 그 외 페이지 관련
Route::get('/lunchBreak',[LunchBreakController::class,'index'])->name('lunchBreak');
