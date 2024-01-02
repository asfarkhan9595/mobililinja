<?php

use App\Http\Controllers\Superadmin\Customer\CustomerController;

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('customers', CustomerController::class)->middleware(['role:superadmin|admin']);
});

?>
