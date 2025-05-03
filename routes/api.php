<?php

use App\Modules\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/test', 'listAllProducts');

    Route::post('', 'createProduct');

    Route::get('{productId}', 'getProductById');

});