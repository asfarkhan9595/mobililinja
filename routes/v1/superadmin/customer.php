<?php

use App\Http\Controllers\Superadmin\Customer\CustomerController;

Route::group(['prefix'=>'customers'],function(){
    Route::get('manage', [CustomerController::class,'index'])->name('superadmin.customers.manage');
    Route::post('store', [CustomerController::class,'store'])->name('superadmin.customer.store');
});

?>