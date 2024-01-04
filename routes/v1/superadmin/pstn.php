<?php

use App\Http\Controllers\Superadmin\PSTN\PSTNController;

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('pstn', PSTNController::class)->middleware(['role:superadmin|admin']);
});

?>
