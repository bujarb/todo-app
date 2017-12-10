<?php
Route::get('/','ItemController@welcome');
Route::get('list','ItemController@index')->name('list');
Route::post('list','ItemController@create');
Route::post('delete','ItemController@delete');
Route::post('update','ItemController@update');
