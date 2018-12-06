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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('cockpit.')->group(function(){
  Route::prefix('cockpit')->group(function(){
    Route::get('', 'CockpitController@index')->name('index');
  });
});

Route::name('dashboard.')->group(function(){
  Route::prefix('dashboard')->group(function(){
    Route::get('', 'DashboardController@index')->name('index');
  });
});

Route::name('weather.')->group(function(){
  Route::prefix('weather')->group(function(){
    Route::get('{lat},{long}', 'WeatherController@get')->name('get')->where(['lat'=> '[+-]?([0-9]*[.])?[0-9]+', 'long'=>'[+-]?([0-9]*[.])?[0-9]+']);
  });
});
