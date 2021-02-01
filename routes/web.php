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
Route::get('/logout','LoginController@logout');
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@validateLogin');
Route::group(['middleware' => 'auth'], function(){
    //Home
    Route::get('/','HomeController@index');

    //Patients
    Route::get('/patients','PatientController@index');
    Route::post('/patient/store','PatientController@store');
    Route::post('/patient/update','PatientController@update');
    Route::post('/patient/destroy','PatientController@destroy');

    //Worksheets
    Route::get('/patient/earlypregnancy/{id}','EarlyPregnancyController@index');
    Route::get('/patient/sonographicfindings/{id}','SonographicController@index');
    Route::get('/patient/trimester/{id}','TrimesterController@index');

    //early pregnancy
    Route::post('/patient/earlypregnancy/{id}','EarlyPregnancyController@store');

    //sonographic findings
    Route::post('/patient/sonographicfindings/{id}','SonographicController@store');

    //2nd and 3rd trimister


    //history
    Route::get('/patient/history/{id}','HistoryController@index');
    Route::get('/patient/history/{id}/{admission_id}/{admission_type}','HistoryController@show');

    //Schedule
    Route::get('/schedule','ScheduleController@index');

    //Configs
    Route::get('/greetings','ConfigController@greetings');
});
