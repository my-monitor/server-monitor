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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/servers', 'ServersController@index')->name('servers.home');
Route::get('/servers/create', 'ServersController@create')->name('servers.create');
Route::post('/servers', 'ServersController@store')->name('servers.store');
