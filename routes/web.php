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

//公開側
Route::get('/', 'IndexController@index')
->name('index');

Route::get('/product/{id}', 'DetailController@index')
->name('product');

Route::get('/category/{id}', 'CategoryController@index')
->name('category');

Route::get('/contact/', 'ContactController@index')
->name('contact');

Route::post('/contact/', 'ContactController@back');

Route::post('/contact/confirm/', 'ContactController@confirm')
->name('contact_confirm');

Route::post('/contact/finish/', 'ContactController@finish')
->name('contact_finish');

Route::get('/cart/', 'CartController@index')
->name('cart');

Route::post('/cart/', 'CartController@addItem');

Route::get('/purchase/', 'PurchaseController@index')->middleware('CheckCart')
->name('purchase');

Route::post('/purchase/', 'PurchaseController@back')->middleware('CheckCart');

Route::post('/purchase/confirm/', 'PurchaseController@confirm')->middleware('CheckCart')
->name('purchase_confirm');

Route::post('/purchase/finish/', 'PurchaseController@finish')->middleware('CheckCart')
->name('purchase_finish');

//ajax
Route::post('/cart/remove/', 'CartController@removeItem')
->name('cart_remove');
Route::post('/cart/quantity/', 'CartController@quantityChange')
->name('cart_quantity');

//管理側
Route::get('/admin/', 'Admin\IndexController@index')
->middleware('CheckAdminLogin');
Route::get('/admin/login/', 'Admin\LoginController@login');
Route::post('/admin/login/', 'Admin\LoginController@loginCheck');
Route::get('/admin/logout/', 'Admin\LoginController@logout')
->name('admin_logout');

$v = Config('const.admin_side_nav');
foreach ($v as $k => $vv) {
	$k2 = ucfirst($k); //先頭大文字
	Route::get('/admin/' . $k . '/', "Admin\\{$k2}Controller@index")
	->middleware('CheckAdminLogin')
	->name('admin_'. $k);
	
	Route::get('/admin/' . $k . '/edit/', "Admin\\{$k2}Controller@create")
	->middleware('CheckAdminLogin')
	->name('admin_create_'. $k);

	Route::post('/admin/' . $k . '/edit/val', "Admin\\{$k2}Controller@val")
	->middleware('CheckAdminLogin')
	->name('admin_val_'. $k);

	Route::post('/admin/' . $k . '/edit/', "Admin\\{$k2}Controller@create_exe")
	->middleware('CheckAdminLogin');

	Route::get('/admin/' . $k . '/edit/{id}', "Admin\\{$k2}Controller@update")
	->middleware('CheckAdminLogin')
	->name('admin_update_'. $k);

	Route::post('/admin/' . $k . '/edit/{id}', "Admin\\{$k2}Controller@update_exe")
	->middleware('CheckAdminLogin');
}

// 送信メール本文のプレビュー
Route::get('/mailable/purchase', function () {
    // $Purchase = App\Purchase::find(1);
	// return new App\Mail\PurchasePaid($Purchase);
	return new App\Mail\Purchase();
});