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
    Route::post('/patient/history/{id}/{admission_id}/{admission_type}','HistoryController@update');

    //print
    Route::get('/print/earlyPregnancy/{admission_id}','PrintController@earlyPregnancy');
    Route::get('/print/sonographic/{admission_id}','PrintController@sonographic');
    Route::get('/print/trimester/{admission_id}','PrintController@trimester');

    //Schedule
    Route::get('/schedule','ScheduleController@index');
    Route::get('/schedule/get','ScheduleController@getSchedule')->name('get.schedule');
    Route::post('/schedule/store','ScheduleController@store')->name('add.schedule');
    Route::post('/schedule/update','ScheduleController@update')->name('update.schedule');
    Route::get('/schedule/destroy/{id}','ScheduleController@destroy')->name('destroy.schedule');

    // x-editable
    Route::post('/patients/update/x/','PatientController@updateX')->name('update.patient');
    Route::post('/admission/update/x/','AdmissionController@updateX')->name('update.admission');
    Route::post('/earlypregnancy/update/x/','EarlyPregnancyController@updateX')->name('update.earlyPregnancy');
    Route::post('/sonographics/update/x/','SonographicController@updateX')->name('update.sonographics');
    Route::post('/trimester/update/x/','TrimesterController@updateX')->name('update.trimester');

    //settings
    Route::get('/settings/doctors','DoctorController@index');
    Route::post('/settings/doctors/store','DoctorController@store')->name('add.doctor');
    Route::post('/settings/doctors/update','DoctorController@update')->name('update.doctor');
    Route::post('/settings/doctors/destroy','DoctorController@destroy')->name('destroy.doctor');

    //users
    Route::get('/settings/users','UserController@index');
    Route::post('/settings/users/update','UserController@udpate')->name('update.level');

    //Configs
    Route::get('/greetings','ConfigController@greetings');
});
