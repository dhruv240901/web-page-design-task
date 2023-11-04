<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('signup', [AuthController::class,'signup'])->name('signup');
Route::post('signup', [AuthController::class,'customSignup'])->name('custom-signup');
Route::post('checkUniqueEmail', [AuthController::class,'checkUniqueEmail'])->name('check_unique_email');
Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'customLogin'])->name('custom-login');
Route::get('changePassword', [AuthController::class,'viewChangePassword'])->name('view-change-password')->middleware('auth');
Route::post('changePassword', [AuthController::class,'changePassword'])->name('change-password')->middleware('auth');

Route::group(['middleware' => ['auth','firstlogin']], function(){
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::prefix('user')->group(function(){
        Route::post('store',[UserController::class,'store'])->name('store-user');
        Route::post('update',[UserController::class,'update'])->name('update-user');
        Route::post('delete',[UserController::class,'destroy'])->name('delete-user');
    });
});
