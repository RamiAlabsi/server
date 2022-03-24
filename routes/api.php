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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(
    [
        'middleware' => [ 'lang' ]
    ], function(){
Route::post('register','api\RegisterApiController@register')->name('register');
Route::post('login','api\loginController@login')->name('login');

//=============setting==================================
Route::get('setting','api\indexController@setting');
// ==========get country api============================
Route::get('country','api\indexController@countries');


// ==========language==================================
Route::get('language','api\indexController@language');

// ==========index page================================
Route::post('/index','api\indexController@index');


//=========single product==============================
//---------comments-------------------
Route::post('add/comment','api\productController@addComments');
//--------single product--------------
Route::post('single/product','api\productController@single_product');
//--------leave review---------------
Route::post('product/leaveReview', 'api\productController@leaveReview');

//-------fav product--------------------
Route::post('add/product/toFavourite', 'api\productController@toggleFavorite');
    });
//--------brand products---------------
Route::post('brand/products','api\productController@brand_product');
//========================categories======================
Route::post('category/products','api\productController@product_category');
//===========================users========================
//------------profile-------------------
Route::post('profile','api\userController@profile');
//------------orders--------------------
Route::post('user/orders','api\userController@userOrder');
//------------update profile-----------
Route::post('update/profile','api\userController@update_profile');

//-----------user addresses------------
Route::post('user/add/address','api\userController@user_addresses');

Route::post('user/edit/address','api\userController@edit_address');
//------------reviews------------------
Route::post('user/wishlist','api\userController@wishlist');

//================================filter=====================
Route::post('filter','api\filterController@filter');
//----------------search-----------------
Route::post('search','api\filterController@search');
Route::get('/clearing',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
});