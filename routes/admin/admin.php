<?php

/*
  |--------------------------------------------------------------------------
  | Web Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


foreach (glob(__DIR__ . '/includes/*.php') as $filename) {
    require_once($filename);
}

/* 404 Routes Starts */
Route::get('admin/{path}', 'DashboardController@fnf')->where('path', '.+')->name('fnf');
/* 404 Routes Ends */
