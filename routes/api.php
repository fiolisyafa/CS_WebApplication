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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
   'middleware' => 'api',
   'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');  
});

Route::group(['prefix' => 'dashboard'], function ($router) {

	//gets the users' existing itineraries
	Route::get('/', 'DashboardController@index');

	//return cities and activity types for users to select
	Route::get('/activitytype', 'DashboardController@getActivityTypes');
	Route::get('/cities', 'DashboardController@getCities');

	//confirm new itinerary
	Route::post('/create', 'DashboardController@store');

	//opens a specific itinerary
	Route::get('/{id}', 'DashboardController@show');

	//updates the data of an existing itinerary
	Route::put('/{id}/edit', 'DashboardController@update');

	//deletes an itinerary
	Route::delete('/{id}/delete', 'DashboardController@destroy');
});

Route::group(['prefix' => 'itinerary'], function ($router) {

	//gets all the activities in a specific itinerary
	Route::get('/{id}/selected', 'UsersActivityController@returnSelected');
	Route::get('/{id}/suggested', 'UsersActivityController@returnSuggested');
	Route::get('/{id}/custom', 'UsersActivityController@returnCustom');

	//displays suggested activities
	Route::get('/{id}/browse', 'ActivityController@index');

	//stores a suggested activity as a selected activity
	Route::put('/{id}/add/{ac_id}', 'UsersActivityController@storeSuggested');

	//stores a custom activity
	Route::put('/{id}/create', 'UsersActivityController@storeCustom');
	
	//deletes an activity
	Route::delete('/{id}/{ac_id}/delete', 'UsersActivityController@destroy');

	//returns the total budget and all the fees
	Route::get('/{id}/budget', 'BudgetController@show');

	//edit budget
	Route::put('/{id}/budget/edit', 'BudgetController@update');
});

//allows users to register
Route::post('register', 'Auth\RegisterController@register');
