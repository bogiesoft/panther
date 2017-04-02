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

Route::group(['prefix' => 'v1'], function()
{
    // Public
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'AuthenticateController@register');

    Route::post('location/search', 'LocationSearchController@search');
    Route::post('location/autocomplete', 'LocationSearchController@autocomplete');

    Route::get('hotels/{id}', 'HotelsController@show');
    Route::get('hotels/search/{query}', 'HotelsController@search');
});

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function()
{
    Route::post('hotels', 'HotelsController@store');
    Route::get('hotels', 'HotelsController@index');
    Route::put('hotels/{id}', 'HotelsController@update');
});

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth', 'hasHotel']], function()
{
    // Admin
    //Route::resource('rooms', 'RoomsController');
    //Route::resource('guests', 'GuestsController');
    //Route::resource('stays', 'StaysController');
    //Route::resource('beds', 'BedsController');
    //Route::resource('employees', 'EmployeesController');
    //Route::resource('products', 'ProductsController');

    // Employees
    //Route::resource('purchases', 'PurchasesController');
});
