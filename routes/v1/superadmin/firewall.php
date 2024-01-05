<?php

use App\Http\Controllers\Superadmin\Firewall\FirewallController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('firewalls', FirewallController::class)->middleware(['role:superadmin|admin']);
});

?>
