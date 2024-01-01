<?php

use App\Http\Controllers\Superadmin\Customer\CustomerController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'customers','as'=>'superadmin.'],function(){
    Route::resource('customer', CustomerController::class)->middleware(['role:superadmin|admin']);
});

?>
