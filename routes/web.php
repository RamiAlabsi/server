<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/clearing',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
});
  

//------------news letter----------------------
Route::post('subscripe/newsletter','WebsiteController@subscripe_newsletter')->name('subscripe_newsletter');

Route::put('users/{id}', "UserController@update");
Route::get('dhl','DHLController@create');
// Auth routes group /////////////////////////////////////////////////////////
Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'ShoppingController@checkout_create');
    Route::post('/checkout', 'ShoppingController@checkout_store');
    Route::get('/my_account', 'WebsiteController@my_account');
    Route::get('/orders/{order_id}', 'WebsiteController@orders_show');
    Route::get('/order_completed', 'ShoppingController@order_completed');
    Route::get('/cart', 'ShoppingController@cart');
    Route::get('/shop', 'WebsiteController@shop');
    Route::get('/product_detail', 'WebsiteController@product_detail');
    Route::get('/wishlist', 'WebsiteController@wishlist');

    Route::prefix('/chat')->group(function(){
        Route::get('/', 'ChatController@index');
        Route::post('/send', 'ChatController@send');
        Route::get('/{other_peer_id}/load/', 'ChatController@load');
        Route::get('/{conversation_id}', 'ChatController@show');
        Route::get('/user_offer/{user_offer_id}', 'ChatController@userOfferChat');
    });
});

// General pages without auth /////////////////////////////////////////////////////////
Route::get('/', 'WebsiteController@index')->name('home');

Route::get('products', "ProductController@index");
Route::get('products/{id}/{with_trashed?}', "ProductController@show");
Route::post('products/{id}/request', 'ProductController@makeRequest');
Route::post('products/{id}/leaveReview', 'ProductController@leaveReview');

Route::get('/404', 'WebsiteController@error');

Route::get('/about', 'GeneralsController@about');
// Route::get('/blog', 'WebsiteController@blog');
// Route::get('/contact', 'GeneralsController@contact');
Route::get('/faq', 'GeneralsController@faq');
Route::get('/term_condition', 'GeneralsController@term_condition');

// Ajax routes group /////////////////////////////////////////////////////////

Route::prefix('ajax')->group(function () {
    Route::get('/products', 'AjaxController@getProducts');
    Route::get('/categories/attributes', 'AjaxController@getCategoryAttributes');
    Route::post('/favourites/toggle', 'AjaxController@toggleFavorite')->middleware('auth');
    Route::get('/favourites/load', 'AjaxController@loadFavourites')->middleware('auth');

    Route::prefix('cart')->middleware('auth')->group(function () {
        Route::get('/', 'AjaxController@getCart');
        Route::post('/toggle', 'AjaxController@toggleCart');
    });
});

Route::get('stores', 'StoreController@index');
Route::get('stores/{id}', 'StoreController@show');

