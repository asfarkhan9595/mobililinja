<?php


use App\Http\Controllers\Superadmin\Trunk\TrunkController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'superadmin.'],function(){
    Route::resource('trunks', TrunkController::class)->middleware(['role:superadmin|admin']);
});

?>
