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
    Route::get('/chart','HomeController@chart')->name('chart');

    //Patients
    Route::get('/patients','PatientController@index');
    Route::post('/patient/store','PatientController@store');
    Route::post('/patient/update','PatientController@update');
    Route::post('/patient/destroy','PatientController@destroy');

    //Worksheets
    Route::get('/patient/earlypregnancy/{id}','EarlyPregnancyController@index');
    Route::get('/patient/sonographicfindings/{id}','SonographicController@index');
    Route::get('/patient/trimester/{id}','TrimesterController@index');

    //admission
    Route::post('/admission/destroy','AdmissionController@destroy')->name('delete.admission');

    //early pregnancy
    Route::get('/patient/earlypregnancy/{id}','EarlyPregnancyController@store')->name('add.earlyPregnancy');
    Route::post('/patient/earlypregnancy/{id}','EarlyPregnancyController@store');

    //sonographic findings
    Route::get('/patient/sonographicfindings/{id}','SonographicController@store')->name('add.sonographic');
    Route::post('/patient/sonographicfindings/{id}','SonographicController@store');

    //2nd and 3rd trimister
    Route::get('/patient/trimester/{id}','TrimesterController@store')->name('add.trimester');

    //history
    Route::get('/patient/history/{id}','HistoryController@index');
    Route::get('/patient/history/{id}/{admission_id}/{admission_type}','HistoryController@show');

    //Schedule
    Route::get('/schedule','ScheduleController@index');

    // x-editable
    Route::post('/patients/update/x/','PatientController@updateX')->name('update.patient');
    Route::post('/admission/update/x/','AdmissionController@updateX')->name('update.admission');
    Route::post('/earlypregnancy/update/x/','EarlyPregnancyController@updateX')->name('update.earlyPregnancy');
    Route::post('/sonographics/update/x/','SonographicController@updateX')->name('update.sonographics');
    Route::post('/trimester/update/x/','TrimesterController@updateX')->name('update.trimester');

    //Configs
    Route::get('/greetings','ConfigController@greetings');
});
