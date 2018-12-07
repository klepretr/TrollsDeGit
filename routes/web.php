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
    Route::get('changeTheme', 'CockpitController@changeTheme')->name('changeTheme');
  });
});

Route::name('dashboard.')->group(function(){
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
    Route::get('editstuff/{id}', 'DashboardController@editstuff')->name('editstuff');
    Route::post('editstuffAction', 'DashboardController@editstuffAction')->name('editstuffAction');
    Route::post('sendAlert', 'AlertsController@sendAlert')->name('sendAlert');
    Route::get('myAlerts', 'AlertsController@showMyAlerts')->name('myAlerts');
    Route::get('alerts', 'AlertsController@alerts')->name('alerts');
    Route::post('storeAlert', 'AlertsController@storeAlert')->name('storeAlert');
    Route::get('editagent/{id}', 'DashboardController@editagent')->name('editagent');
    Route::post('editagentAction', 'DashboardController@editagentAction')->name('editagentAction');


  });
});

Route::name('weather.')->group(function(){
  Route::prefix('weather')->group(function(){
    Route::get('{lat},{long}', 'WeatherController@get')->name('get')->where(['lat'=> '[+-]?([0-9]*[.])?[0-9]+', 'long'=>'[+-]?([0-9]*[.])?[0-9]+']);
  });
});



