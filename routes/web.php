<?php

use App\Http\Controllers\Customerarea\Lostpassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Customer Area
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Customerarea'], function() {

    /*Start Auth*/
    Route::get('auth', [
        'as'   => 'customerarea-auth',
        'uses' => 'AuthController@index'
    ]);

    Route::get('/recuperar-senha',
    [
        'as'    => 'lost-password',
        'uses'  => 'LostpassworController@index'
    ]);

    Route::post('/recuperar-senha/validation', [
        'as'    => 'recovery-password',
        'uses'  => 'LostpassworController@store'
    ]);

    Route::get('/recuperar-senha/email-enviado', [
        'as'    => 'emailEnviado',
        'uses'  => 'LostpassworController@show'
    ]);

    Route::get('/password/reset', [
        'as'    => 'password.reset',
        'uses'  => 'ResetPassworController@index'
    ]);

    Route::post('/password/update',
    [
        'as'    => 'password.update',
        'uses'  => 'ResetPassworController@update'
    ]);

    Route::get('/email', [
        'as'    => 'showEmail',
        'uses'  => 'LostpassworController@showEmail'
    ]);


    Route::post('auth', [
        'as'   => 'customerarea-auth',
        'uses' => 'AuthController@store'
    ]);

    /**start registre-se */
    Route::get('/registre-se',[
        'as'    =>  'create-user',
        'uses'  =>  'RegistrationController@index'
    ]);

    Route::post('/registre-se/validacao',[
        'as'    =>  'create-user',
        'uses'  =>  'RegistrationController@store'
    ]);
    /**end-register */

    Route::get('logout', [
        'as'   => 'customerarea-logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::get('/auth/alterar/sucesso/{token}', [
        'as'    => 'senha-alterada-sucesso',
        'uses'  => 'ValidationTokenChangeEmail@index'
    ]);

    /*End Auth*/

    Route::group(['middleware' => 'auth:customer'], function() {

        /*Home*/
        Route::get('/', [
            'as'   => 'customerarea-home',
            'uses' => 'HomeController@index'
        ]);

        /*Start My Data*/
        Route::get('meus-dados', [
            'as'   => 'customerarea-my-data',
            'uses' => 'My_dataController@show'
        ]);

        Route::put('meus-dados', [
            'as'   => 'customerarea-my-data',
            'uses' => 'My_dataController@update'
        ]);
        /*End My Data*/

        /*Start My card*/
        Route::get('cartoes', [
            'as'   => 'customerarea-my-card',
            'uses' => 'My_cardController@index'
        ]);

        Route::post('cartoes/validation/{id_customer}', [
            'as'   => 'customerarea-my-card-save',
            'uses' => 'My_cardController@store'
        ]);

        Route::get('meus/cartoes', [
            'as'     => 'my-cards',
            'uses'   => 'My_cardController@show'
        ]);

        Route::get('/meus/cartoes/delete/{id}', [
            'as'     => 'delet-card',
            'uses'   => 'My_cardController@delete'
        ]);
        /*End My Card*/

        // Route::post('/auth/customer/register',[
        //     'as'    =>  'create-user',
        //     'uses'  =>  'RegistrationController@create'
        // ]);

    });
    
});


/*
|--------------------------------------------------------------------------
| Web Routes Dashboard
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Dashboard', 'prefix' => 'sistema'], function() {

    /*Start Auth*/
    Route::get('auth', [
        'as'   => 'dashboard-auth',
        'uses' => 'AuthController@index'
    ]);

    Route::post('auth', [
        'as'   => 'dashboard-auth',
        'uses' => 'AuthController@store'
    ]);

    Route::get('logout', [
        'as'   => 'dashboard-logout',
        'uses' => 'AuthController@logout'
    ]);
    /*End Auth*/

    Route::group(['middleware' => 'auth:dashboard'], function() {

        /*Home*/
        Route::get('/', [
            'as'   => 'dashboard-home',
            'uses' => 'HomeController@index'
        ]);

        /*Start Customer*/
        Route::get('clientes', [
            'as'   => 'dashboard-customer',
            'uses' => 'CustomerController@index'
        ]);
        Route::get('clientes/novo', [
            'as'   => 'dashboard-customer-create',
            'uses' => 'CustomerController@create'
        ]);

        Route::post('clientes/novo', [
            'as'   => 'dashboard-customer-create',
            'uses' => 'CustomerController@store'
        ]);

        Route::get('clientes/{customer_id}', [
            'as'   => 'dashboard-customer-update',
            'uses' => 'CustomerController@show'
        ]);

        Route::put('clientes/{customer_id}', [
            'as'   => 'dashboard-customer-update',
            'uses' => 'CustomerController@update'
        ]);

        Route::get('clientes/{customer_id}/excluir', [
            'as'   => 'dashboard-customer-delete',
            'uses' => 'CustomerController@destroy'
        ]);
        /*End Customer*/

        Route::group(['prefix' => 'configuracoes'], function() {

            
            /*Start User*/
            Route::get('usuarios', [
                'as'   => 'dashboard-user',
                'uses' => 'UserController@index'
            ]);

            Route::get('usuarios/novo', [
                'as'   => 'dashboard-user-create',
                'uses' => 'UserController@create'
            ]);

            Route::post('usuarios/novo', [
                'as'   => 'dashboard-user-create',
                'uses' => 'UserController@store'
            ]);

            Route::get('usuarios/{user_id}', [
                'as'   => 'dashboard-user-update',
                'uses' => 'UserController@show'
            ]);

            Route::put('usuarios/{user_id}', [
                'as'   => 'dashboard-user-update',
                'uses' => 'UserController@update'
            ]);

            Route::get('usuarios/{user_id}/excluir', [
                'as'   => 'dashboard-user-delete',
                'uses' => 'UserController@destroy'
            ]);
            /*End User*/


            /*Start Countrie*/
            Route::get('paises', [
                'as'   => 'dashboard-countrie',
                'uses' => 'CountrieController@index'
            ]);

            Route::get('paises/novo', [
                'as'   => 'dashboard-countrie-create',
                'uses' => 'CountrieController@create'
            ]);

            Route::post('paises/novo', [
                'as'   => 'dashboard-countrie-create',
                'uses' => 'CountrieController@store'
            ]);

            Route::get('paises/{user_id}', [
                'as'   => 'dashboard-countrie-update',
                'uses' => 'CountrieController@show'
            ]);

            Route::put('paises/{user_id}', [
                'as'   => 'dashboard-countrie-update',
                'uses' => 'CountrieController@update'
            ]);

            Route::get('paises/{user_id}/excluir', [
                'as'   => 'dashboard-countrie-delete',
                'uses' => 'CountrieController@destroy'
            ]);
            /*End Countrie*/

            // /*Start State*/
            // Route::get('estados', [
            //     'as'   => 'dashboard-state',
            //     'uses' => 'StateController@index'
            // ]);

            // Route::get('estados/novo', [
            //     'as'   => 'dashboard-state-create',
            //     'uses' => 'StateController@create'
            // ]);

            // Route::post('estados/novo', [
            //     'as'   => 'dashboard-state-create',
            //     'uses' => 'StateController@store'
            // ]);

            // Route::get('estados/{user_id}', [
            //     'as'   => 'dashboard-state-update',
            //     'uses' => 'StateController@show'
            // ]);

            // Route::put('estados/{user_id}', [
            //     'as'   => 'dashboard-state-update',
            //     'uses' => 'StateController@update'
            // ]);

            // Route::get('estados/{user_id}/excluir', [
            //     'as'   => 'dashboard-state-delete',
            //     'uses' => 'StateController@destroy'
            // ]);
            // /*End State*/

        });
    });

});

