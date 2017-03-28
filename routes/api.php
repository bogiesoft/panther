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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth','hasHotel']], function()
{
 
});

Route::group(['prefix' => 'v1'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'AuthenticateController@register');

    Route::post('location/search', 'LocationSearchController@search');
    Route::post('location/autocomplete', 'LocationSearchController@autocomplete');

    Route::resource('hotels', 'HotelsController');
    Route::resource('rooms', 'RoomsController');
    Route::resource('guests', 'GuestsController');
    Route::resource('stays', 'StaysController');
    Route::resource('beds', 'BedsController');
    Route::resource('employees', 'EmployeesController');
    Route::resource('products', 'ProductsController');
    Route::resource('purchases', 'PurchasesController');
});
