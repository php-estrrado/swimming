<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('user/coaches', 'CoachController@coaches')->name('coaches');
    Route::get('user/disabled/coaches', 'CoachController@disabledCoaches')->name('disabled_coaches');
    Route::get('user/coaches/new', 'CoachController@newCoaches');
    Route::get('user/coach/{id}', ['uses' => 'CoachController@coach'], function($id) { })->where('id', '[0-9/]+');
    Route::get('user/restore/{id}', ['uses' => 'CoachController@restore'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/coach/save', 'CoachController@save');
    Route::post('/coach/update/status', 'CoachController@updateStatus');
    Route::post('/coach/disable', 'CoachController@disable');
    Route::get('coach/aprove/{id}/{status}', ['uses' => 'CoachController@updateNewStatus'], function($id,$status) { })->where(['id'=>'[0-9/]+','status'=>'[0-9/]+']);
    
});
/* PaymentController Routes Ends */


