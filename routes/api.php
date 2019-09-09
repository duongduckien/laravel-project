<?php

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

/*
 * Registration
 */
Route::post('register', 'AuthController@create');

/*
 * Authentication
 */
Route::post('authorize', 'AuthController@login');