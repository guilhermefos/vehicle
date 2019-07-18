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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('register', ['as' => 'register', 'uses' => 'RegisterController@register']);
        Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout'])->middleware(['auth:api']);
    });

    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['prefix' => 'vehicle', 'middleware' => 'scope:self'], function () {
            Route::get('/', ['as' => 'vehicle.index', 'uses' => 'VehicleController@index']);
            Route::post('/store', ['as' => 'vehicle.store', 'uses' => 'VehicleController@store']);
            Route::put('/update', ['as' => 'vehicle.update', 'uses' => 'VehicleController@update']);
            Route::delete('/destroy/{id}', ['as' => 'vehicle.destroy', 'uses' => 'VehicleController@destroy']);
        });

    });
});
