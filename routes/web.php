<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home')
    ->middleware('auth');

Route::get('/patients/create-step1', 'PatientController@createStep1')->name('patients.create-step1')
    ->middleware('auth');
Route::post('/patients/create-step1', 'PatientController@postCreateStep1')->name('patients.create-step1')
    ->middleware('auth');

Route::get('/patients/create-step2', 'PatientController@createStep2')->name('patients.create-step2')
    ->middleware('auth');
Route::post('/patients/create-step2', 'PatientController@postCreateStep2')->name('patients.create-step2')
    ->middleware('auth');

Route::get('/patients/create-step3', 'PatientController@createStep3')->name('patients.create-step3')
    ->middleware('auth');
Route::post('/patients/create-step3', 'PatientController@postCreateStep3')->name('patients.create-step3')
    ->middleware('auth');

Route::get('/patients/create-step3', 'PatientController@createStep3')->name('patients.create-step3')
    ->middleware('auth');
Route::post('/patients/create-step3', 'PatientController@postCreateStep3')->name('patients.create-step3')
    ->middleware('auth');

Route::get('/patients/create-step4', 'PatientController@createStep4')->name('patients.create-step4')
    ->middleware('auth');
Route::post('/patients/create-step4', 'PatientController@postCreateStep4')->name('patients.create-step4')
    ->middleware('auth');

Route::get('/patients/create-step5', 'PatientController@createStep5')->name('patients.create-step5')
    ->middleware('auth');
Route::post('/patients/create-step5', 'PatientController@postCreateStep5')->name('patients.create-step5')
    ->middleware('auth');

Route::resource('patients', "PatientController")
    ->middleware('auth');

Auth::routes();
