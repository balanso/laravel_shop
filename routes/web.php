<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
  'reset' => false,
  'confirm' => false,
  'verify' => false,
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
  Route::group(['prefix'=>'person', 'namespace'=>'Person', 'as'=>'person.'], function () {
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
  });

  Route::group(['middleware' => 'user.isAdmin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/reset', 'ResetController@reset')->name('admin.reset');
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
  });
});


Route::get('/', 'MainController@index')->name('index');
Route::get('/categories', 'MainController@categories')->name('categories');

Route::group(['prefix' => 'basket', 'middleware' => 'order.isNotEmpty'], function () {
  Route::get('', 'BasketController@basket')->name('basket');
  Route::get('/place', 'BasketController@basketPlace')
    ->name('basket-place');
  Route::post('/confirm', 'BasketController@basketConfirm')->name('basket-confirm');
  Route::post('/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
});

Route::post('/basket/add/{product_id}', 'BasketController@basketAdd')->name('basket-add');

Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');
