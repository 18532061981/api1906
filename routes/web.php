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
Route::prefix('/wx')->group(function () {
    Route::any('access_token','Test\TestController@access_token');
    Route::any('curl1','Test\TestController@curl1');
    Route::any('curl2','Test\TestController@curl2');
    Route::any('guzzle','Test\TestController@guzzle');
    Route::any('count1','Test\TestController@count1');
    Route::any('api2','Test\TestController@api2');
    Route::any('api3','Test\TestController@api3');
});


Route::prefix('/goods')->group(function () {
    Route::any('detail','Goods\GoodsController@detail');
    Route::any('getUrl','Goods\GoodsController@getUrl');
    Route::any('redisStr1','Goods\GoodsController@redisStr1');
});