<?php

use App\Http\Controllers\AdminCon;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\gymController;
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


Route::prefix('admin')->controller(AdminCon::class)->group(function () {

    Route::post('register_admin', 'store');
    Route::post('create_user', 'addUser');
    Route::post('create_coach', 'addCoach');
    Route::post('create_contract', 'create_cont');
    Route::post('create_sub', 'create_sub');
    Route::get('users_inactive/{id}', 'showOnlyInActive');
    Route::get('users_active/{id}', 'showOnlyActive');
    Route::get('show_sub/{id}', 'showSub');
    Route::get('show_cont/{id}','showCont');
    Route::post('add_payment','addPayment');
});

Route::prefix('login')->controller(LoginController::class)->group(function () {

    Route::post('admin', 'adminLogin');
    Route::post('coach_login', 'coachLogin');
    Route::post('user_login', 'userLogin');
});

Route::prefix('user')->controller(UsersController::class)->group(function () {

    Route::get('show_data', 'show');
    Route::post('edit_days', 'editTrainingDays');

    Route::get('show_all_exe/', 'showAllExes');
    Route::get('show_exe/{id}', 'showExe');
    Route::get('show_days', 'showDays');
    Route::get('show_sub', 'showSub');

});

Route::prefix('coach')->controller(CoachController::class)->group(function () {
    Route::get('show_cont','showCont');
    Route::get('show_all_users/{id}', 'showAllUsers');
    Route::get('show_private_users/{id}', 'showPrivateUsers');
    Route::get('coach_available/{id}', 'showAvailableCoaches'); //this need to be moved to the admin
    Route::post('create_qual', 'create_qual');
    Route::post('add_exe/{id}', 'addexe');
    Route::get('show_coach/{id}', 'show');              // this need to be duplicated and move one to the admin
    Route::get('coach_unavailable/{id}', 'showUnAvailableCoaches');  //this need to be moved to the admin
});

Route::get('show_gym/{id}', [gymController::class, 'show']);
Route::get('gym/show_all_users/{id}', [gymController::class, 'showAllUsers']);
Route::get('gym/show_all_coaches/{id}', [gymController::class, 'showAllCoaches']);

