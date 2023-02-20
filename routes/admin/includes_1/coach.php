<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('user/coaches', 'CoachController@coaches')->name('coaches');
    Route::get('user/coach/{id}', ['uses' => 'CoachController@coach'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/coach/save', 'CoachController@save');
    Route::post('/coach/update/status', 'CoachController@updateStatus');
    Route::post('/coach/disable', 'CoachController@disable');
    
});
/* PaymentController Routes Ends */


