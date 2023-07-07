<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

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
Route::prefix('')->middleware('check')->group(function(){
    Route::get('login',[LoginController::class,'login'])->name('login');
    Route::post('login-post',[LoginController::class,'login_validate'])->name('login_validate');

    Route::get('register',[LoginController::class,'register'])->name('register');

    Route::post('register-post',[LoginController::class,'register_validate'])->name('register_validate');

});
Route::get('logout',[LoginController::class,'logout'])->name('logout');


Route::prefix('')->middleware('confirmEmail','auth')->group(function(){
    Route::get('confirm',[LoginController::class,'confirm'])->name('confirm');
    Route::post('ConfirmPost',[LoginController::class,'ConfirmPost'])->name('ConfirmPost');


    Route::get('home',[LoginController::class,'home'])->name('home');

});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('User/trash',[UserController::class,'trash'])->name('User.trash');
    Route::get('User/restore/{id}',[UserController::class,'restore'])->name('User.restore');
    Route::delete('User/forcedelete/{id}',[UserController::class,'forcedelete'])->name('User.forcedelete');
    Route::resource('User',UserController::class);

});
