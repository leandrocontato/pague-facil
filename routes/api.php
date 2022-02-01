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

Route::group(['namespace' => 'Api'], function() {
        
    Route::post('/auth/customer/register',   'AuthCustomerController@register');
    Route::post('/auth/customer',      'AuthCustomerController@login');

    Route::middleware(['auth:apicustomer,customer,dashboard'])->group(function () { 
        
        //Customer
        Route::get('customer/me',               'CustomerController@show_me');
        Route::put('customer/me',               'CustomerController@update_me');
        Route::put('customer/me/credentials',   'CustomerController@update_me_partial'); 
        Route::apiResource('customer', CustomerController::class); 
         
        Route::post('/auth/customer/logout', 'AuthCustomerController@logout');

        //Countrie
        Route::apiResource('countrie', CountrieController::class); 

        //State
        Route::apiResource('state', StateController::class);

        //Citie
        Route::apiResource('citie', CitieController::class);

        //Card        
        Route::apiResource('card',CardController::class);

        Route::put('/auth/alterar/password' , [
            'as'    => 'change.password.and.email',
            'uses'  => 'CustomerController@change'
        ]);

        Route::post('/auth/boleto', [
            'as'    =>  'boleto-endpoint',
            'uses'  =>  'BoletoController@RecoveryEndPoint'
        ]);
    });
});
