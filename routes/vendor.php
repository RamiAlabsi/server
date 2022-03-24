<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'VendorController@index')->name('vendor');

Route::resource('/products', 'ProductController')->middleware('hasStore');
Route::prefix('/products')->group(function () {
    Route::get('/{id}/suspend', 'ProductController@suspend');
    Route::get('/{id}/activate', 'ProductController@activate');
    Route::post('/{id}/change_discount_rate', 'ProductController@changeDiscountRate');
    Route::get('/{id}/comments/show','ProductController@comments');
    Route::get('/{id}/rates/show','ProductController@reviews');
});
Route::get('/comment/{id}/status','ProductController@comment_status');

Route::resource('/stores', 'StoreController');
Route::resource('/orders', 'OrderController', [
    'only' => ['index', 'update']
]);

Route::resource('/user_offers', 'UserOfferController', [
    'only' => ['index', 'destroy']
]);
