<?php

Auth::routes();

Route::group(['middleware' => 'auth'],function (){
    Route::get('/', 'ServersController@index')->name('servers.home');
    Route::get('/home', 'ServersController@index')->name('servers.home');

    Route::get('/servers', 'ServersController@index')->name('servers.home');
    Route::get('/servers/create', 'ServersController@create')->name('servers.create');
    Route::post('/servers', 'ServersController@store')->name('servers.store');
    Route::get('/servers/{id}/show', 'ServersController@show')->name('servers.show');
    Route::get('/servers/{id}/edit', 'ServersController@edit')->name('servers.edit');
    Route::put('/servers/{id}/update', 'ServersController@update')->name('servers.update');

    Route::get('/uptime', 'UptimeController@index')->name('uptime.home');
    Route::get('/uptime/create', 'UptimeController@create')->name('uptime.create');
    Route::post('/uptime', 'UptimeController@store')->name('uptime.store');
    Route::get('/uptime/{id}/show', 'UptimeController@show')->name('uptime.show');
    Route::get('/uptime/{id}/edit', 'UptimeController@edit')->name('uptime.edit');
    Route::put('/uptime/{id}/update', 'UptimeController@update')->name('uptime.update');

});