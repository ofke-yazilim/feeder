<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/all/twits', [\App\Http\Controllers\HomeController::class,'index'])->name('api.all.twits')->middleware('authorization.api.feeder');
Route::post('/v1/register', [\App\Http\Controllers\Auth\UserController::class,'store'])->name('api.store');
Route::post('/v1/login', [\App\Http\Controllers\Auth\AuthController::class,'login'])->name('api.login.post');
Route::get('/v1/profile', [\App\Http\Controllers\Auth\UserController::class,'show'])->name('api.show')->middleware('authorization.api.feeder');
Route::get('/v1/logout', [\App\Http\Controllers\Auth\AuthController::class,'logout'])->name('api.logout');
Route::get('/v1/validate', [\App\Http\Controllers\Auth\AuthController::class,'validate_user'])->name('api.validate_user');
Route::get('/v1/twit/list', [\App\Http\Controllers\TwitListController::class,'index'])->name('api.twit.index')->middleware('authorization.api.feeder');
Route::get('/v1/get/twits', [\App\Http\Controllers\TwitListController::class,'get_twits'])->name('api.twit.get')->middleware('authorization.api.feeder');
Route::get('/v1/show/twit/{id}', [\App\Http\Controllers\TwitListController::class,'edit'])->name('api.twit.show')->middleware('authorization.api.feeder');
Route::post('/v1/twit/update/{id}', [\App\Http\Controllers\TwitListController::class,'update'])->name('api.twit.update')->middleware('authorization.api.feeder');

Route::get('/v1/faker/data', [\App\Http\Controllers\FakerController::class,'index'])->name('api.faker.index')->middleware('faker');
Route::put('/v1/faker/update/{id}', [\App\Http\Controllers\FakerController::class,'update'])->name('api.faker.update')->middleware('faker');
