<?php

/*
  |--------------------------------------------------------------------------
  | Cache Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/optimize', function() {
    Artisan::call('optimize');
    return "Optimized";
});

Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/clear-compiled', function() {
    Artisan::call('clear-compiled');
    return "Compiled Cache is cleared";
});

Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return "Route Cache is cleared";
});

Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return "Config Cache is cleared";
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return "View Cache is cleared";
});

Route::get('/key-generate', function() {
    $key = Artisan::call('key:generate');
    return "New Key is Generated:" . $key;
});

Route::get('/composer-dump-autoload', function() {
    $exec = exec('composer dump-autoload');
    return $exec;
});


