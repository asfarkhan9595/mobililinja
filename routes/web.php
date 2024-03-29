<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('_back.auth.login');
});

Auth::routes();

Route::group(['namespace'=>'App\Http\Controllers'],function(){
    // Dashboard
    Route::group(['middleware'=>'auth'],function(){
        Route::get('dashboard', function () {
            return view('_back.superadmin.dashboard');
        })->name('superadmin.dashboard');
    });
});
Route::group(['middleware'=>'auth','namespace'=>'App\Http\Controllers'],function(){
    Route::group(['prefix'=>'admin'],function(){
        // Use glob to dynamically include route files from the specified folder
        foreach (glob(__DIR__.'/v1/superadmin/*.php') as $file) {
            include $file;
        }
    });
});
Route::group(['middleware'=>'auth','namespace'=>'App\Http\Controllers'],function(){
    Route::group(['prefix'=>'customer'],function(){
        // Use glob to dynamically include route files from the specified folder
        foreach (glob(__DIR__.'/v1/customer/*.php') as $file) {
            include $file;
        }
    });
});
