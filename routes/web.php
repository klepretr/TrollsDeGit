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

Route::name('dashboard.')->middleware('auth')->group(function(){
  Route::prefix('dashboard')->group(function(){
    Route::get('', 'DashboardController@index')->name('index');
    Route::get('generateTokenRegistration', 'DashboardController@registerToken')->name('registerToken');
    Route::post('generateTokenRegistration', 'DashboardController@storeToken')->name('storeToken');
    Route::post('changeTheme', 'DashboardController@changeTheme')->name('changeTheme');
    Route::get('report/{id}', 'DashboardController@report')->name('report');
    Route::get('gestionAgent', 'DashboardController@gestionAgent')->name('gestionAgent');
    Route::get('gestionMateriel', 'DashboardController@gestionMateriel')->name('gestionMateriel');
    Route::get('createMission', 'DashboardController@createMission')->name('createMission');
    Route::post('createMissionAction', 'DashboardController@createMissionAction')->name('createMissionAction');

  });
});




