<?php
Route::group(['prefix' => 'coach'], function() {
    Route::get('/courses', 'Coach\CourseController@courses');
    Route::get('course/{id}/{sid}/{aid}', ['uses' => 'Coach\CourseController@studSubmitActivity'], function($id,$sid,$aid) { })->where(['id'=>'[0-9/]+','sid'=>'[0-9/]+','aid'=>'[0-9/]+']);
    Route::get('course/{id}/{sid}', ['uses' => 'Coach\CourseController@courseStudent'], function($id,$sid) { })->where('id', '[0-9/]+')->where('sid', '[0-9/]+');
    Route::get('course/{id}', ['uses' => 'Coach\CourseController@course'], function($id) { })->where('id', '[0-9/]+');
    
    Route::get('/submitted/activities', 'Coach\CourseController@submitedActivities');
    Route::get('submitted/activity/{id}', ['uses' => 'Coach\CourseController@submitedActivity'], function($id) { })->where('id', '[0-9/]+');
    Route::get('/activity/session/requests', 'Coach\CourseController@sessionRequests');
    Route::get('/activity/session/request/{id}', ['uses' => 'Coach\CourseController@sessionRequest'], function($id) { })->where('id', '[0-9/]+');
    
    Route::get('assigned/courses', 'Coach\CourseController@assignCourses')->name('assigned_courses');
    Route::get('assigned/course/{id}', ['uses' => 'Coach\CourseController@assignCourse'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/update/course/activity', 'Coach\CourseController@updateStatus');
    Route::post('session/update/status', 'Coach\CourseController@updateSessionStatus');
    Route::post('activity/session/save', 'Coach\CourseController@saveSession');
    Route::post('save/activity/review', 'Coach\CourseController@saveActvityReview');
    Route::post('/activity/medias', 'Coach\CourseController@activityMedias');
});