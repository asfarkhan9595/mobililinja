<?php


use App\Http\Controllers\Superadmin\Outbound\OutboundController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('outbounds', OutboundController::class)->middleware(['role:superadmin|admin']);
});

?>