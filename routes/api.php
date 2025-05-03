<?php

use App\Modules\Order\CalculationController;
use App\Modules\Order\OrderController;
use Illuminate\Support\Facades\Route;


Route::controller(CalculationController::class)->prefix('calculate')->group(function () {
    
    Route::post('', 'assignment');

});