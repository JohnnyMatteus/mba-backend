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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/forgotPassword', 'Api\AuthController@forgotPassword');
Route::post('/validToken', 'Api\AuthController@validToken');
Route::post('/registerNewPassword', 'Api\AuthController@registerNewPassword');

Route::get('/authorize/{provider}/redirect', 'Api\SocialAuthController@register');
 
Route::get('/authorize/{provider}/callback', 'Api\SocialAuthController@handleProviderCallback');


Route::middleware('auth:api')->prefix('v1')->name('v1.')->group(function () {

    Route::group(['prefix' => 'usuario'], function () {
        Route::get('/dados-usuario', 'Api\UsuarioController@index');
        Route::get('/logout', 'Api\UsuarioController@logout');

    });
    Route::resource('usuario', 'Api\UsuarioController');


    Route::group(['prefix' => 'acl'], function () {
        Route::resource('role', 'Api\Acl\RolesController');
        Route::resource('permission', 'Api\Acl\PermissionsController');
    
    });

    
});
