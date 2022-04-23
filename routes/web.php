<?php

use App\Http\Controllers\AccountController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Staff;


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
})->name('dashboard')->middleware('StaffOrOwnerOrAdmin');

Route::get('/accounts', "AccountConfirmation@index")->name('accounts')->middleware('OwnerOrAdmin');

Route::post('/approveAccount', "AccountConfirmation@approveAccount")->name('approveAccount');

Route::post('/declineAccount', "AccountConfirmation@declineAccount")->name('declineAccount');

//navbar routes

Route::get('/reportIncident', function () {
    return view('regular/reportIncident');
})->name("reportIncident")->middleware('Staff');

Route::get('/residentForm', function () {
    return view('regular/residentForm');
})->name("residentForm")->middleware('StaffOrOwner');


Route::get('/staffView', 'RotaController@index')->name("staffView")->middleware('StaffOrOwner');

Route::get('/support', function () {
    return view('regular/support');
})->name("support")->middleware('StaffOrOwnerOrAdmin');

Route::get('/training', function () {
    return view('regular/training');
})->name("training")->middleware('StaffOrOwner');

Route::get('/logout', 'AccountController@logout')->name('logout');

Route::post('/residentUpload', 'ResidentController@ResidentUpload')->name('residentUpload')->middleware('Owner');

Route::post('/ABCUpload', 'ResidentController@ABCUpload')->name('ABCUpload')->middleware('Staff');

Route::post('/incident_formUpload', 'ResidentController@incident_formUpload')->name('incident_formUpload')->middleware('Staff');

Route::post('/appointmentUpload', 'ResidentController@appointmentUpload')->name('appointmentUpload')->middleware('Staff');

Route::get('/residentEdit/{id?}', 'ResidentController@ResidentEdit')->name("residentEdit")->middleware('Owner');

Route::post('/residentUpdate', 'ResidentController@residentUpdate')->name('residentUpdate')->middleware('Owner');


Route::get('/sessionForm/{id?}', 'SessionController@index')->name('sessionForm')->middleware('Staff');
Route::post('/updateSessionForm', 'SessionController@handleSession')->name('updateSessionForm')->middleware('Staff');

Route::post('/uploadRota', 'RotaController@handleRota')->name('handleRota')->middleware('StaffOrOwner');


