<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('courses', 'CourseController@courses')->name('courses');
    Route::get('course/{id}', ['uses' => 'CourseController@course'], function($id) { })->where('id', '[0-9/]+');
    Route::post('course/save/{id}', ['uses' => 'CourseController@save'], function($id) { })->where('id', '[0-9/]+');
    Route::get('courses/approvel/pending', 'CourseController@pendingApprovels')->name('courses_approvel');
    Route::post('/course/update/status', 'CourseController@changeStatus');
    Route::post('/course/disable', 'CourseController@disable');
    
    Route::get('course/badges', 'CourseController@badges')->name('badges');
    Route::get('course/badge/save', 'CourseController@saveBadge');
});
/* PaymentController Routes Ends */
