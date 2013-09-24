<?php

Route::get('/', function(){ return Redirect::to('dashboard'); });


Route::get('dashboard', array('before' => 'auth', 'uses'=>'DashboardController@get_index'));


Route::get('login', array('uses'=>'DashboardController@get_login'));


Route::post('login', array('uses'=>'DashboardController@post_login'));


Route::get('logout', array('uses'=>'DashboardController@get_logout'));


Route::get('signup', array('uses'=>'DashboardController@get_signup'));


Route::post('signup', array('uses'=>'DashboardController@post_signup'));


Route::get('incoming', array('before' => 'auth', 'uses'=>'DashboardController@get_incoming'));


Route::get('onlineusers', array('before' => 'auth', 'uses'=>'DashboardController@get_onlineusers'));


Route::get('pm', array('before' => 'auth', 'uses'=>'DashboardController@get_pm'));


Route::post('pm', array('before' => 'auth', 'uses'=>'DashboardController@post_pm'));






