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
    Route::post('add_payment','addPayment');
    Route::post('coach_available', 'showAvailableCoaches');
    Route::post('show_all_coaches','showAllCoaches');

    Route::get('users_inactive', 'showOnlyInActive');
    Route::post('all_users','showAllUsers');
    Route::get('users_active', 'showOnlyActive');
    Route::get('show_sub/{id}', 'showSub');
    Route::get('show_cont/{id}','showCont');
    Route::get('show_coach/{id}', 'showCoach');

    Route::get('coach_unavailable', 'showUnAvailableCoaches');

});

Route::prefix('login')->controller(LoginController::class)->group(function () {

    Route::post('admin', 'adminLogin');
    Route::post('coach', 'coachLogin');
    Route::post('user', 'userLogin');
});

Route::prefix('user')->controller(UsersController::class)->group(function () {

    Route::get('show_data', 'show');
    Route::get('show_all_exe/', 'showAllExes');
    Route::get('show_exe/{id}', 'showExe');
    Route::get('show_days', 'showDays');
    Route::get('show_sub', 'showSub');

    Route::post('edit_days', 'editTrainingDays');

});

Route::prefix('coach')->controller(CoachController::class)->group(function () {
    Route::get('show_cont','showCont');
    Route::get('show_all_users', 'showAllUsers');
    Route::get('show_private_users', 'showPrivateUsers');
    Route::get('show_coach', 'show');

    Route::post('create_qual', 'create_qual');
    Route::post('add_exe/{id}', 'addexe');

});

Route::get('show_gym/{id}', [gymController::class, 'show']);
Route::get('gym/show_all_users/{id}', [gymController::class, 'showAllUsers']);

