<?php

use App\Http\Controllers\AccountController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;


//Regular
Route::get('/', function () {
    return view('login');
})->name("login");


Route::get('/register', function () {
    return view('register');
})->name("register");


Route::post('/login', 'AccountController@login')->name('LoginPOST');

Route::post('/registerAccount', 'AccountController@register')->name('RegisterPOST');

//Auth
Route::get('/dashboard', function(){
    return view('regular/dashboard');
})->name('dashboard');

Route::get('/accounts', "AccountConfirmation@index")->name('accounts');

Route::post('/approveAccount', "AccountConfirmation@approveAccount")->name('approveAccount');

Route::post('/declineAccount', "AccountConfirmation@declineAccount")->name('declineAccount');

//navbar routes

Route::get('/reportIncident', function () {
    return view('regular/reportIncident');
})->name("reportIncident");

Route::get('/residentForm', function () {
    return view('regular/residentForm');
})->name("residentForm");


Route::get('/staffView', 'RotaController@index')->name("staffView");

Route::get('/support', function () {
    return view('regular/support');
})->name("support");

Route::get('/training', function () {
    return view('regular/training');
})->name("training");

Route::get('/logout', 'AccountController@logout')->name('logout');

Route::post('/residentUpload', 'ResidentController@ResidentUpload')->name('residentUpload');

Route::post('/ABCUpload', 'ResidentController@ABCUpload')->name('ABCUpload');

Route::post('/incident_formUpload', 'ResidentController@incident_formUpload')->name('incident_formUpload');

Route::post('/appointmentUpload', 'ResidentController@appointmentUpload')->name('appointmentUpload');

Route::get('/residentEdit/{id?}', 'ResidentController@ResidentEdit')->name("residentEdit");

Route::post('/residentUpdate', 'ResidentController@residentUpdate')->name('residentUpdate');


Route::get('/sessionForm/{id?}', 'SessionController@index')->name('sessionForm');
Route::post('/updateSessionForm', 'SessionController@handleSession')->name('updateSessionForm');

Route::post('/uploadRota', 'RotaController@handleRota')->name('handleRota');


