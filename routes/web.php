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
Route::get('/', 'IndexController@index');
Route::get('/news/{id}', 'DetailController@index');
Route::get('/category/{id}', 'CategoryController@index');
Route::get('/contact/', 'ContactController@index');
Route::post('/contact/', 'ContactController@back');
Route::post('/contact/confirm/', 'ContactController@confirm');
Route::post('/contact/finish/', 'ContactController@finish');

//管理側
Route::get('/admin/', 'Admin\IndexController@index');
Route::get('/admin/login/', 'Admin\LoginController@login');
Route::post('/admin/login/', 'Admin\LoginController@login_check');
Route::get('/admin/logout/', 'Admin\LoginController@logout');

$v = Config('const.admin_side_nav');
foreach ($v as $k => $vv) {
    $k2 = ucfirst($k);//先頭大文字
	Route::get('/admin/' . $k . '/', "Admin\\{$k2}Controller@index");
	Route::post('/admin/' . $k . '/', "Admin\\{$k2}Controller@search");
	//
	Route::get('/admin/' . $k . '/edit/', "Admin\\{$k2}Controller@create");
    Route::post('/admin/' . $k . '/edit/val', "Admin\\{$k2}Controller@val");
	Route::post('/admin/' . $k . '/edit/', "Admin\\{$k2}Controller@create_exe");
	//
	Route::get('/admin/' . $k . '/edit/{id}', "Admin\\{$k2}Controller@update");
	Route::post('/admin/' . $k . '/edit/{id}', "Admin\\{$k2}Controller@update_exe");
}
//
// Route::get('/admin/category/sort/', 'Admin_categoryController@sort');
// Route::post('/admin/category/sort/', 'Admin_categoryController@sort_exe');
