<?php

use App\Http\Controllers\AdminCon;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//the route to create the admin with the gym
Route::post('register_admin',[AdminCon::class,'store']);
Route::get('admin_details/{id}',[AdminCon::class,'show']);
Route::post('admin_login',[LoginController::class,'adminLogin']);
Route::post('create_user',[UsersController::class,'store']);
Route::post('create_coach',[CoachController::class,'store']);
Route::post('create_sub_user',[UsersController::class,'create_sup']);
