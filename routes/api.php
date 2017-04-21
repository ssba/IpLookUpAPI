<?php

use Illuminate\Http\Request;

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

Route::get('ip/check',['middleware' => ['view'],'uses'=>'IpController@check','as'=>'ip']);

Route::get('/ip',function(){
    return Redirect::to('ip',array(
        'ip'=>'46.118.159.230'
    ));
});