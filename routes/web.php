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
Route::post('signup', [AuthController::class,'CustomSignup'])->name('custom-signup');
Route::post('checkemailunique', [AuthController::class,'CheckEmailUnique'])->name('check_email_unique');
Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'CustomLogin'])->name('custom-login');
Route::get('reset-password', [AuthController::class,'logout'])->name('reset-password');

Route::group(['middleware' => ['auth']], function(){
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::get('list',[UserController::class,'UserList'])->name('user-list');
    Route::post('store-user',[UserController::class,'store'])->name('store-user');
    Route::post('update-user',[UserController::class,'update'])->name('update-user');
    Route::post('delete-user',[UserController::class,'destroy'])->name('delete-user');
});
