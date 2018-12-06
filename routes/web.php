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


Route::name('api.')->group(function(){
  Route::prefix('api')->group(function(){
    Route::get('missionfuture', 'MissionController@getAllFutureMission')
        ->name('missionfuture');
    Route::get('missionpast', 'MissionController@getAllPastMission')
        ->name('missionpast');
  });
});

