<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('courses', 'CourseController@courses')->name('courses');
    Route::get('course/{id}', ['uses' => 'CourseController@course'], function($id) { })->where('id', '[0-9/]+');
    Route::get('courses/approvel/pending', 'CourseController@pendingApprovels')->name('courses_approvel');
    Route::get('/course/upload/media', 'CourseController@uploadCourseMedia');
    
    Route::post('/course/save', 'CourseController@save');
    Route::post('/course/update/status', 'CourseController@changeStatus');
    Route::post('/course/disable', 'CourseController@disable');
    Route::post('/milestone/save', 'CourseController@saveMilestone');
    Route::post('/activity/save', 'CourseController@saveActivity');
    Route::post('/activity/medias', 'CourseController@activityMedias');
    Route::post('/delete/media', 'CourseController@deleteMedia');
    Route::post('/group/activities', 'CourseController@assignedActivities');
    Route::post('/group/activities/assign', 'CourseController@assignGroupActivities');
    Route::post('/course/group/save', 'CourseController@saveGroup');
    Route::post('course/group/delete', 'CourseController@deleteGroup');
    
    Route::get('course/badges', 'CourseController@badges')->name('badges');

    Route::post('course/badge/save', 'CourseController@saveBadge');
});
/* PaymentController Routes Ends */
