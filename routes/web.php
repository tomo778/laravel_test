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

/*
|--------------------------------------------------------------------------
| 公開側
|--------------------------------------------------------------------------
|
*/
Auth::routes();
Route::get('/', 'ProductController@index')
	->name('index');
Route::get('/product/{id}', 'ProductController@detail')
	->name('product');
Route::get('/category/{id}', 'ProductController@category')
	->name('category');
Route::group(['prefix' => 'contact'], function () {
	Route::get('/', 'ContactController@index')
		->name('contact');
	Route::post('/', 'ContactController@back');
	Route::post('confirm', 'ContactController@confirm')
		->name('contact_confirm');
	Route::post('finish', 'ContactController@finish')
		->name('contact_finish');
});
Route::group(['prefix' => 'cart'], function () {
	Route::get('/', 'CartController@index')
		->name('cart');
	Route::post('/', 'CartController@addItem');
	//ajax
	Route::post('remove', 'CartController@removeItem')
		->name('cart_remove');
	Route::post('quantity', 'CartController@quantityChange')
		->name('cart_quantity');
});
Route::group(['prefix' => 'purchase'], function () {
	Route::get('/', 'PurchaseController@index')->middleware('CheckCart')
		->name('purchase');
	Route::post('/', 'PurchaseController@back')->middleware('CheckCart');
	Route::post('confirm', 'PurchaseController@confirm')->middleware('CheckCart')
		->name('purchase_confirm');
	Route::post('finish', 'PurchaseController@finish')->middleware('CheckCart')
		->name('purchase_finish');
});
Route::group(['prefix' => 'mypage'], function () {
	Route::get('/', 'MypageController@index')->name('mypage');
	Route::get('address', 'MypageController@address')->name('mypage_address');
	Route::get('history', 'MypageController@history')->name('mypage_history');
	Route::get('create', 'MypageController@create')->name('mypage_create');
	Route::post('create_exe', 'MypageController@create_exe')->name('mypage_create_exe');
	Route::get('update/{id?}', 'MypageController@update')->name('mypage_update');
	Route::post('update_exe', 'MypageController@update_exe')->name('mypage_update_exe');
});

/*
|--------------------------------------------------------------------------
| 管理側
|--------------------------------------------------------------------------
|
*/
// Route::get('/admin/', 'Admin\IndexController@index')
// 	->middleware('CheckAdminLogin');
// Route::get('/admin/login/', 'Admin\LoginController@login');
// Route::post('/admin/login/', 'Admin\LoginController@loginCheck');
// Route::get('/admin/logout/', 'Admin\LoginController@logout')
// 	->name('admin_logout');

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', 'Admin\IndexController@index')
		->middleware('auth:admin');
	//login logout   
	Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
	//register
	Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
	Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');

	$v = Config('const.admin_side_nav');
	foreach ($v as $k => $vv) {
		$k2 = ucfirst($k); //先頭大文字
		Route::get($k, "Admin\\{$k2}Controller@index")
			->middleware(['auth:admin', 'AdminCommon'])
			->name('admin_' . $k);

		Route::get($k . '/edit', "Admin\\{$k2}Controller@create")
			->middleware(['auth:admin', 'AdminCommon'])
			->name('admin_create_' . $k);

		Route::post($k . '/edit/val', "Admin\\{$k2}Controller@val")
			->middleware(['auth:admin', 'AdminCommon'])
			->name('admin_val_' . $k);

		Route::post($k . '/edit', "Admin\\{$k2}Controller@create_exe")
			->middleware(['auth:admin', 'AdminCommon']);

		Route::get($k . '/edit/{id}', "Admin\\{$k2}Controller@update")
			->middleware(['auth:admin', 'AdminCommon'])
			->name('admin_update_' . $k);

		Route::post($k . '/edit/{id}', "Admin\\{$k2}Controller@update_exe")
			->middleware(['auth:admin', 'AdminCommon']);
	}
	//
	Route::post('product/checkbox', "Admin\ProductController@checkbox")
		->middleware(['auth:admin', 'AdminCommon']);
});


// 送信メール本文のプレビュー
Route::get('/mailable/purchase', function () {
	// $Purchase = App\Purchase::find(1);
	// return new App\Mail\PurchasePaid($Purchase);
	return new App\Mail\Purchase();
});
