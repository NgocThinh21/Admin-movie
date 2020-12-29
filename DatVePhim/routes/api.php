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

        //api
        Route::group(['prefix'=>'api'],function(){
            Route::get('phim','APIController@index')->name('dsPhim');;
    
            //them rap
            Route::get('them','AdminController@ThemGC')->name('themGC');
            Route::post('them','AdminController@postThemGC')->name('themGC');
    
            //sua rap
            Route::get('sua/{id}','AdminController@SuaGC')->name('suaGC');
            Route::post('sua/{id}','AdminController@postSuaGC')->name('suaGC');
    
            //xoa rap
            Route::get('xoa/{id}','AdminController@XoaGC')->name('xoaGC');
        });  

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
