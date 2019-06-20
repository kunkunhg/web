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

Route::get('/', function () {
    return view('welcome');
});

route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSP'
]);

route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChiTiet'
]);

route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddToCart'
]);

route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);

Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckOut'
]);

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckOut'
]);

Route::get('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'PageController@getDangNhap'
]);

Route::post('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'PageController@postDangNhap'
]);

Route::get('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@getDangKy'
]);

Route::post('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@postDangKy'
]);

Route::get('dang-xuat',[
	'as'=>'dangxuat',
	'uses'=>'PageController@getDangXuat'
]);

Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
/////////////////*ROUTE ADMIN**********

// route::group([
// 	'prefix'=>'admin',
// 	'as'=>'admin.',
// 	'namespace'=>'Admin'
// ],
// function(){
// 	Route::get('login1','LoginController@loginView')->name('loginView');

// 	route::POST('handleLogin','LoginController@handleLogin')->name('handleLogin');

// 	route::POST('logout','LoginController@logout')->name('logout');

// });

// route::group([
// 	'prefix'=>'admin',
// 	'as'=>'admin.',
// 	'namespace'=>'Admin',
// 	'middleware' => ['adminLogined','web']
// ],
// function(){
// 	Route::get('dashboard','DashboardController@index')->name('dashboard');

// 	route::get('products','ProductsController@index')->name('products');

// 	route::get('addProduct','ProductsController@addProduct')->name('addProduct');
// 	route::post('handle-add-products','ProductsController@handleAddProducts')->name('handleAddProducts');

// 	route::post('deleteProduct','ProductsController@deleteProduct')->name('deleteProduct');
// 	route::get('editProduct/{id}','ProductsController@editProduct')->name('editProduct')->where(['id'=>'[0-9]+']);
// 	Route::post('handle-edit-product/{id}','ProductController@handleEditProduct')
// 				->name('handleEditProduct')
// 				->where(['id'=>'[0-9]+']);
// });