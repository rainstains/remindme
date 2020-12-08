<?php

use Illuminate\Http\Request;

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

//Auth
Route::post('signin','Api\AuthController@signIn');
Route::post('signup','Api\AuthController@signUp');
Route::get('signout','Api\AuthController@signOut');

//Task
Route::post('tasks/create','Api\TaskController@create')->middleware('jwtAuth');
Route::post('tasks/update','Api\TaskController@update')->middleware('jwtAuth');
Route::post('tasks/finnish','Api\TaskController@finnished')->middleware('jwtAuth');
Route::post('tasks/delete','Api\TaskController@delete')->middleware('jwtAuth');
Route::get('task','Api\TaskController@getTask')->middleware('jwtAuth');
Route::get('tasks/finnished','Api\TaskController@getFinnishTasks')->middleware('jwtAuth');
Route::get('tasks/ongoing','Api\TaskController@getOnGoingTasks')->middleware('jwtAuth');
