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

Route::group(['middleware' => ['auth:api', 'tenant'], 'prefix' => 'v1', 'name' => 'v1.'], function () {

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
    Route::group(['prefix' => 'fornecedor'], function () {
        Route::get('/initialize', 'Api\FornecedorController@initialize');
    }); 
    Route::resource('fornecedor', 'Api\FornecedorController');
    
    Route::resource('componente', 'Api\ComponentesController');
    Route::resource('sistema', 'Api\SistemasController');
    Route::resource('notificacao', 'Api\NotificacaoController');
    Route::resource('plano-manutencao', 'Api\PlanoManutencaoController');
    Route::resource('item-plano-manutencao', 'Api\ItemPlanoManutencaoController');
    Route::resource('atividade', 'Api\AtividadeController');
    Route::resource('periodicidades', 'Api\PeriodicidadesController');

    Route::group(['prefix' => 'acl'], function () {
        Route::resource('role', 'Api\Acl\RolesController');
        Route::resource('permission', 'Api\Acl\PermissionsController');    
    });

    Route::resources([
        'usuario' => 'Api\UsuarioController',
        'menu' => 'Api\MenuController'
    ]);    
});
