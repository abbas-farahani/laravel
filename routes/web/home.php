<?php

use App\Http\Controllers\Profile\IndexController;
use App\Http\Controllers\Profile\TokenAuthController;
use App\Http\Controllers\Profile\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    auth()->loginUsingId(8);
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/auth/google' , [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback']);
Route::get('/auth/token' ,[\App\Http\Controllers\Auth\AuthTokenController::class, 'getToken'])->name('2fa.token');
Route::post('/auth/token' ,[\App\Http\Controllers\Auth\AuthTokenController::class, 'postToken']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/profile')->middleware('auth')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('profile');
    Route::get('/2fa', [TwoFactorAuthController::class, 'manageTwoFactorAuth'])->name('profile.2fa');
    Route::post('/2fa', [TwoFactorAuthController::class, 'postManageTwoFactorAuth']);

    Route::get('/2fa/phone', [TokenAuthController::class, 'getPhoneVerify'])->name('profile.2fa.phone');
    Route::post('/2fa/phone', [TokenAuthController::class, 'postPhoneVerify']);
});

