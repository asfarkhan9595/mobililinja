<?php


use App\Http\Controllers\Customer\Phonebook\PhonebookController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'customer.'], function () {
    Route::resource('phonebooks', PhonebookController::class)->middleware(['role:superadmin|admin|customer']);
});
