<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('registered/courses', 'MyCourseController@courses')->name('registered_courses');
    Route::get('registered/course/{id}', ['uses' => 'MyCourseController@course'], function($id) { })->where('id', '[0-9/]+');
    Route::get('courses/approvel/pending', 'MyCourseController@pendingApprovels')->name('courses_approvel');
    Route::get('/activity/session/requests', 'MyCourseController@sessionRequests');
    Route::get('/activity/session/request/{id}', ['uses' => 'MyCourseController@sessionRequest'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('registered/course/update/status', 'MyCourseController@changeStatus');
    Route::post('registered/course/disable', 'MyCourseController@disable');
    Route::post('registered/activity/medias', 'MyCourseController@activityMedias');
    Route::post('session/update/status', 'MyCourseController@updateSessionStatus');
    Route::post('activity/session/save', 'MyCourseController@saveSession');
    
});
/* PaymentController Routes Ends */
