<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'AdminController@index')->name('dashboard');

Route::resource('brands','brandController');

Route::get('/users', 'UserController@index')->name('users');
Route::post('/users/edit', 'UserController@update')->name('users.update');
Route::post('users/delete', 'UserController@destroy');

Route::resource('categories', 'CategoryController', [
    'except' => 'create'
]);
Route::get('categories/create/{level_category_id}', 'CategoryController@create');

Route::resource('stores', 'StoreController', [
    'only' => ['index', 'destroy', 'show']
]);
Route::resource('products', 'ProductController', [
    'only' => ['index', 'destroy']
]);
Route::resource('countries', 'CountryController', [
    'except' => ['show']
]);
Route::resource('cities', 'CityController', [
    'except' => ['show']
]);
Route::resource('states', 'StateController', [
    'except' => ['show']
]);
Route::resource('orders', 'OrderController', [
    'only' => ['index']
]);

////////////// General Website Settings Routes /////////////////////
Route::get('home_page_settings', 'WebsiteSettingController@homePageSettingsEdit');
Route::post('home_page_settings', 'WebsiteSettingController@homePageSettingsUpdate');

Route::resource('category_sales', "CategorySaleController", [
    "except" => ['show', 'edit']
]);
Route::resource('newsLetter', "newsletterController", [
    "except" => ['show' ]
]);

Route::get('website_settings/{page_name}', 'WebsiteSettingController@websiteSettingEdit')->where(['page_name' => 'website_layout|term_condition|about_us']);
Route::post('website_settings/{page_name}', 'WebsiteSettingController@websiteSettingUpdate')->where(['page_name' => 'website_layout|term_condition|about_us']);

Route::resource('faq', 'FaqController', [
    'except' => ['show']
]);


// Route::get('contact_us', 'WebsiteSettingController@contactUsEdit');
// Route::post('contact_us', 'WebsiteSettingController@contactUsUpdate');
