<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\TownshipController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class,'logout']);

    Route::post('/province',[ProvinceController::class, 'store']);
    Route::put('/province/{id}',[ProvinceController::class, 'update']);
    Route::delete('/province/{id}',[ProvinceController::class, 'destroy']);

    Route::post('/district',[DistrictController::class, 'store']);
    Route::put('/district/{id}',[DistrictController::class, 'update']);
    Route::delete('/district/{id}',[DistrictController::class, 'destroy']);

    Route::post('/township',[TownshipController::class, 'store']);
    Route::put('/township/{id}',[TownshipController::class, 'update']);
    Route::delete('/township/{id}',[TownshipController::class, 'destroy']);

    Route::get('/users',[UserController::class, 'index']);
    Route::get('/user/{id}',[UserController::class, 'show']);
    Route::get('/user',[UserController::class, 'showAuth']);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(ProvinceController::class)->group(function(){
    Route::get('/provinces','index');
    Route ::get('/provinces/active','indexActive');
    Route::get('/province/{id}','show');
    Route::get('/province/{id}/districts','showDistricts');
    Route::get('/province/{id}/districts/active','showDistrictsActive');
});

Route::controller(DistrictController::class)->group(function(){
    Route::get('/districts','index');
    Route::get('/districts/active','indexActive');
    Route::get('/district/{id}','show');
    Route::get('/district/{id}/townships','showTownships');
    Route::get('/district/{id}/townships/active','showActiveTownships');
});

Route::controller(TownshipController::class)->group(function(){
    Route::get('/townships','index');
    Route::get('/township/{id}','show');
});