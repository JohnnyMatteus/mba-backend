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
        Route::get('/initialize', 'Api\UsuarioController@initialize');
        Route::get('/dados-usuario', 'Api\UsuarioController@index');
        Route::get('/logout', 'Api\UsuarioController@logout');
    });   

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/initialize', 'Api\MenuController@initialize')->name('v1.initialize');
    });   
    Route::group(['prefix' => 'empresas'], function () {
        Route::get('/initialize', 'Api\EmpresasController@initialize');
    }); 
    Route::resource('empresas', 'Api\EmpresasController');

    Route::group(['prefix' => 'empreendimento'], function () {
        Route::get('/initialize', 'Api\EmpreendimentosController@initialize');
    }); 
    Route::resource('empreendimento', 'Api\EmpreendimentosController');

    Route::group(['prefix' => 'acl'], function () {
        Route::resource('role', 'Api\Acl\RolesController');
        Route::resource('permission', 'Api\Acl\PermissionsController');    
    });

    Route::resources([
        'usuario' => 'Api\UsuarioController',
        'menu' => 'Api\MenuController'
    ]);
    
});
