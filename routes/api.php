<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group(function () {
    Route::name('product.')->group(function () {
        Route::get('/product/{product}/prices', 'Api\\ProductController@getProductPrices')->name('prices');
        Route::get('/product', 'Api\\ProductController@getProductData')->name('data');
    });
});
