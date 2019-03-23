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
//首页
route::any('/','IndexController@Index');



Route::prefix('index')->group(function () {
    route::get('Shopcart','IndexController@Shopcart');
    route::get('Userpage','IndexController@Userpage');
    route::get('Willshare','IndexController@Willshare');
});
//全部商品
Route::prefix('goods')->group(function () {
    route::get('Allshops', 'GoodsController@Allshops');
    route::any('category', 'GoodsController@category');
    route::any('shopcontent', 'ShopcontentController@shopcontent');

});
//注册
Route::prefix('login')->group(function () {
    route::any('Register', 'RegisterController@Register');
    route::any('RegisterDo', 'RegisterController@RegisterDo');
    route::any('RegisterYZ', 'RegisterController@RegisterYZ');
    route::any('Message', 'RegisterController@Message');
    route::any('Noe', 'RegisterController@Noe');
    route::any('code', 'RegisterController@code');

});
//登陆
Route::prefix('login')->group(function () {
    route::any('Login','LoginController@Login');
    route::any('LoginDo','LoginController@LoginDo');
    route::any('Captcha','LoginController@Captcha');
});
//购物车
Route::prefix('cart')->group(function () {
    route::any('Shopcart','ShopcartController@Shopcart');
});