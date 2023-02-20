<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('locations', 'LocationController@locations')->name('locations');
    Route::get('location/{id}', ['uses' => 'LocationController@locations'], function($id) { })->where('id', '[0-9/]+');
    
    
    Route::post('/location/update/status', 'LocationController@changeStatus');
    Route::post('/location/disable', 'LocationController@disable');
    Route::post('location/save/{id}', ['uses' => 'LocationController@save'], function($id) { })->where('id', '[0-9/]+');
});
/* PaymentController Routes Ends */
