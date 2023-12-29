<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'App\Http\Controllers\Superadmin'],function(){
    Route::get('/', 'Auth\LoginController@showLoginform');
    Route::get('login', 'Auth\LoginController@showLoginform')->name('superadmin.login');
    Route::post('dologin', 'Auth\LoginController@login')->name('superadmin.dologin');
    // Dashboard
    Route::group(['middleware'=>'auth:superadmin'],function(){
        Route::get('dashboard', function () {
            return view('_back.superadmin.dashboard');
        })->name('superadmin.dashboard');
    });   
});
Route::group(['middleware'=>'auth:superadmin','namespace'=>'App\Http\Controllers'],function(){
    Route::group(['prefix'=>'customers'],function(){
        Route::get('manage', 'CustomerController@index')->name('superadmin.customers.manage');
        Route::post('store', 'CustomerController@store')->name('superadmin.customer.store');
    });
});