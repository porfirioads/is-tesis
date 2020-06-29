<?php

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

Route::get('usuarios', 'UsuarioController@getUsers');

Route::post('login', 'UsuarioController@login');

Route::group(['middleware' => ['jwt']], function () {
    Route::post('validate_token', 'UsuarioController@validateToken');
});
