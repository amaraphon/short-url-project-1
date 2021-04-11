<?php

///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','UrlController@index');
Route::get('/new','UrlController@create');
Route::get('/limit','UrlController@create');
Route::post('/save','UrlController@store');
Route::get('/gt/{code}','UrlController@check');
Route::delete('/delete/{id}','UrlController@delete');


