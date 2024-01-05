<?php

use App\Http\Controllers\Superadmin\Invoice\InvoiceController;

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('invoices', InvoiceController::class)->middleware(['role:superadmin|admin']);
});

?>
