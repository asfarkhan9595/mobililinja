<?php

use App\Http\Controllers\Superadmin\Customer\CustomerController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'customers','as'=>'superadmin.'],function(){
    Route::resource('customer', CustomerController::class)->middleware(['permission:create-customer,edit-customer,delete-customer,list-customer']);
});

?>
