<?php

use App\Ping;
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

Route::group(['middleware' => ['auth:api']],function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/ping/{key}',function($key){

        $ping = Ping::where('key',$key)->first();
        abort_if(!$ping,404);

        $ping->updateLastTimePing();

        return response(null,200);
    })->name('ping.api');

});
