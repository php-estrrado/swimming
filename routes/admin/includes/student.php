<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('user/students', 'StudentController@students')->name('coaches');
    Route::get('user/disabled/students', 'StudentController@disabledStudents')->name('disabled_coaches');
    Route::get('user/student/{id}', ['uses' => 'StudentController@student'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/student/save', 'StudentController@save');
    Route::post('/student/update/status', 'StudentController@updateStatus');
    Route::post('/student/disable', 'StudentController@disable');
    
});
/* PaymentController Routes Ends */


