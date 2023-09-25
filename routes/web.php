<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('web.home');
Route::get('/register', [\App\Http\Controllers\Auth\UserController::class,'create'])->name('web.create');
Route::post('/register', [\App\Http\Controllers\Auth\UserController::class,'store'])->name('web.store');
Route::get('/login', [\App\Http\Controllers\Auth\UserController::class,'login'])->name('web.login.get');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class,'login'])->name('web.login.post');
Route::get('/profile', [\App\Http\Controllers\Auth\UserController::class,'show'])->name('web.show')->middleware('authorization.feeder');
Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class,'logout'])->name('web.logout');
Route::get('/validate', [\App\Http\Controllers\Auth\AuthController::class,'validate_user'])->name('web.validate_user');
Route::get('/twit/list', [\App\Http\Controllers\TwitListController::class,'index'])->name('web.twit.index')->middleware('authorization.feeder');
Route::get('/get/twits', [\App\Http\Controllers\TwitListController::class,'get_twits'])->name('web.twit.get')->middleware('authorization.feeder');
Route::get('/twit/edit/{id}', [\App\Http\Controllers\TwitListController::class,'edit'])->name('web.twit.edit')->middleware('authorization.feeder');
Route::post('/twit/update/{id}', [\App\Http\Controllers\TwitListController::class,'update'])->name('web.twit.update')->middleware('authorization.feeder');





