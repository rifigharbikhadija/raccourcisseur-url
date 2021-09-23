<?php

Auth::routes();

Route::get('/', 'LinksController@create');
Route::post('/links', 'LinksController@store')->middleware('auth');
Route::get('/links/{link}', 'LinksController@show')->middleware('auth');
Route::get('/delete-link/{id}', 'LinksController@destroy')->middleware('auth');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

Route::get('/all-links', 'LinksController@links');

Route::get('/{hash}', 'LinksController@process');
