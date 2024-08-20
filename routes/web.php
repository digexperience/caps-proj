<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['reset' => false]);



Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['0']], function () {
    Route::get('/dashboard', '\App\Http\Controllers\Dashboard@index')->name('dashboard'); 
    Route::get('/fingerprint', '\App\Http\Controllers\Fingerprint@index')->name('fingerprint');
    Route::resource('/instructors', '\App\Http\Controllers\Instructors'); 
    Route::get('/records', '\App\Http\Controllers\Records@index')->name('records.index'); 
    Route::get('/profile', '\App\Http\Controllers\Profile@index')->name('profile'); 
    Route::get('/records/changeMonth/{direction}', '\App\Http\Controllers\Records@changeMonth')->name('records.changeMonth');
    Route::get('/records/report/{day}/{month}/{year}', '\App\Http\Controllers\Records@report')->name('records.report');
});

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['1']], function () {
    Route::get('/dashboard', '\App\Http\Controllers\Dashboard@index')->name('dashboard'); 
    Route::get('/fingerprint', '\App\Http\Controllers\Fingerprint@index')->name('fingerprint');
    Route::resource('/instructors', '\App\Http\Controllers\Instructors'); 
    Route::get('/records', '\App\Http\Controllers\Records@index')->name('records'); 
    Route::get('/profile', '\App\Http\Controllers\Profile@index')->name('profile');
    Route::get('/records/changeMonth/{direction}', '\App\Http\Controllers\Records@changeMonth')->name('records.changeMonth');
    Route::get('/records/report/{day}/{month}/{year}', '\App\Http\Controllers\Records@report')->name('records.report');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Auth::routes(['reset' => false]);

?>
