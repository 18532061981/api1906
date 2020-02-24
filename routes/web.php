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
//测试
Route::prefix('/test')->middleware('ApiFilter')->group(function(){
    Route::get('/redis','Test\Testcontroller@testredis');   //redis
    Route::get('/file_get_contents','Test\Testcontroller@file_get_contents');   //file_get_contents  get
    Route::get('/curl','Test\Testcontroller@curl');   //curl   get
    Route::get('/curlPost','Test\Testcontroller@curlPost');
    Route::get('/Guzzle','Test\Testcontroller@Guzzle');  //Guzzle   get
    Route::get('/GuzzlePost','Test\Testcontroller@GuzzlePost');  //Guzzle    Post

    Route::post('/post1','Test\Testcontroller@post1');
    Route::post('/post2','Test\Testcontroller@post2');
    Route::post('/post3','Test\Testcontroller@post3');
    Route::post('/upload','Test\Testcontroller@upload');

    Route::post('/guzzleget','Test\Testcontroller@guzzleget');
    Route::post('/guzzlepost1','Test\Testcontroller@guzzlepost1');
    Route::post('/guzzleupload','Test\Testcontroller@guzzleupload');
    Route::post('/guzzlejson','Test\Testcontroller@guzzlejson');

    Route::get('/redisfs','Test\Testcontroller@redisfs');

    Route::get('/md5get','Test\Testcontroller@md5get');
    Route::get('/md5shou','Test\Testcontroller@md5shou');

    Route::get('/verifySign','Test\Testcontroller@verifySign');

    Route::get('/decrypt','Test\Testcontroller@decrypt');

    Route::get('/decrypt1','Test\Testcontroller@decrypt1');  //对称

    Route::get('/verifySign','Test\Testcontroller@verifySign');
    Route::get('/decrypt','Test\Testcontroller@decrypt');
    Route::get('/task','Test\Testcontroller@task');
});


Route::prefix('/goods')->group(function () {
    Route::any('detail','Goods\GoodsController@detail');
    Route::any('getUrl','Goods\GoodsController@getUrl');
    Route::any('redisStr1','Goods\GoodsController@redisStr1');
});