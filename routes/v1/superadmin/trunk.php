<?php


use App\Http\Controllers\Superadmin\Trunk\TrunkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'trunks','as'=>'superadmin.'],function(){
    Route::resource('trunk', TrunkController::class)->middleware(['role:superadmin|admin']);
});

?>
