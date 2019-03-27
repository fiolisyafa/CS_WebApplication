<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/index', function (){
	return view('pages.index');
});

Route::get('/login', function (){
	return view('pages.login');
});

Route::get('/dashboard', function (){
	return view('pages.dashboard');
});

Route::get('/myplan', function (){
	return view('pages.myplan');
});

Route::get('/budget', function () {
    return view('pages.budget');
});

Route::get('/timeline', function () {
    return view('pages.timeline');
});

// Route::get('/login', 'PagesController@login');

// Route::get('/dashboard', 'PagesController@getStarted');




// Route::get('/budget', 'PagesController@budget');

// Route::get('/itinerary', 'PagesController@itinerary');