<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use  App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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

                     //-------Auth route---------//
                                     

Route::post('login', [App\http\Controllers\AuthController::class, 'authenticate']);
//Route::post('login', 'AuthController@authenticate');
Route::post('register', [App\http\Controllers\AuthController::class, 'register']);
//Route::post('register', 'AuthController@register');
Route::get('logout', [App\http\Controllers\AuthController::class, 'logout']);
//Route::post('logout', 'AuthController@logout');
Route::post('refresh', [App\http\Controllers\AuthController::class, 'refresh']);
//Route::post('refresh', 'AuthController@refresh');
Route::get('user-profile', [App\http\Controllers\AuthController::class, 'get_user']);
//Route::post('get_user', 'AuthController@get_user');

                    //-------jobs route---------//  


Route::prefix('job')->group(function () {

    Route::get('list', [App\Http\Controllers\JobController::class, 'list']);

    Route::get('index/{id}', [App\Http\Controllers\JobController::class, 'index']);

    Route::post('add', [App\Http\Controllers\JobController::class, 'store']);

    Route::post('update/{id}', [App\Http\Controllers\JobController::class, 'update']);

    Route::post('delete/{id}', [App\Http\Controllers\JobController::class, 'destroy']);

});


                    //----Applications route---//      

Route::prefix('application')->group(function () {

    Route::get('list', [App\Http\Controllers\ApplicationController::class, 'list']);

    Route::get('index/{id}', [App\Http\Controllers\ApplicationController::class, 'index']);

    Route::post('add', [App\Http\Controllers\ApplicationController::class, 'store']);

    Route::post('update/{id}', [App\Http\Controllers\ApplicationController::class, 'update']);

    Route::post('delete/{id}', [App\Http\Controllers\ApplicationController::class, 'destroy']);


});

Route::prefix('subscribe')->group(function () {

    Route::get('list', [App\Http\Controllers\SubscriberController::class, 'list']);

    Route::post('delete/{id}', [App\Http\Controllers\SubscriberController::class, 'destroy']);

    Route::get('send', [App\Http\Controllers\SubscriberController::class,'send'])->name('email');

    Route::post('email', [App\Http\Controllers\SubscriberController::class, 'sendEmail']);

    Route::post('email/all', [App\Http\Controllers\SubscriberController::class, 'emailTo_all']);

    Route::post('subscribe', [App\Http\Controllers\SubscriberController::class, 'subscribe']);


});

Route::prefix('cv')->group(function () {

    Route::get('list', [App\Http\Controllers\C_vController::class, 'list']);

    Route::get('index/{id}', [App\Http\Controllers\C_vController::class, 'index']);

    Route::post('delete/{id}', [App\Http\Controllers\C_vController::class, 'destroy']);

    Route::post('add', [App\Http\Controllers\C_vController::class, 'store']);

    Route::post('update/{id}', [App\Http\Controllers\C_vController::class, 'update']);

});

Route::prefix('rate')->group(function () {

    Route::get('list', [App\Http\Controllers\RateController::class, 'list']);

    Route::post('delete/{id}', [App\Http\Controllers\RateController::class, 'destroy']);

    Route::post('add', [App\Http\Controllers\RateController::class, 'store']);

});

Route::prefix('dashboard')->group(function () {

    Route::get('index', [App\Http\Controllers\RateController::class, 'index']); 

});


