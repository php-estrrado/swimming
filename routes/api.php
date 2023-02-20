<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    //return $request->user();
//    return response()->json(['usercount' => 0]);
//});

// Users
Route::post('/version', 'VersionController@currentVersion');
Route::post('/users', 'ApiController@users');
Route::post('/register', 'Student\UserController@register');
Route::post('/addUserType', 'Student\UserController@addUserType');
Route::post('/auth/otp', 'Student\UserController@otp');
Route::post('/auth/resendOtp', 'Student\UserController@resendOtp');
Route::post('/login', 'Student\UserController@login');
Route::post('/addNewChild', 'Student\UserController@addNewChild');
Route::post('/addChild', 'Student\UserController@addChild');
Route::post('/relationships', 'Student\UserController@relationships');
Route::post('/childrenList', 'Student\UserController@childrenList');
Route::post('/profile', 'Student\UserController@profile');
Route::post('/profile/update', 'Student\UserController@updateProfile');

// Courses
Route::post('/course/list', 'Student\CourseController@courseList');
Route::post('/location/course/list', 'Student\CourseController@locationCourseList');
Route::post('/course/detail', 'Student\CourseController@courseDetail');
Route::post('/course/badgeList', 'Student\CourseController@badgeList');
Route::post('/course/register', 'Student\CourseController@registerCourse');
Route::post('/course/activity/media/delete', 'Student\CourseController@deleteActivity');


// Locations
Route::post('/course/locations', 'Student\CourseController@locations');
Route::post('/course/location/notify', 'Student\CourseController@locationNotify');

// My Courses
Route::post('/course/myCourses', 'Student\CourseController@myCourses');
Route::post('/course/myActivities', 'Student\CourseController@myActivities');
Route::post('/course/activity/detail', 'Student\CourseController@activityDetail');
Route::post('/course/activity/submit', 'Student\CourseController@submitActivity');
Route::post('/course/activity/media/submit', 'Student\CourseController@submitActivityMedia');

// Chat
Route::post('/chat', 'Student\ChatController@index');
Route::post('/chat/coachList', 'Student\ChatController@coaches');
Route::post('/chat/create', 'Student\ChatController@createChat');
Route::post('/chat/chatHistory', 'Student\ChatController@chatHistory');
Route::post('/chat/message', 'Student\ChatController@sendMessage');
Route::post('/chat/search', 'Student\ChatController@search');

// notification
Route::post('/notifications', 'Student\NotificationController@notifications');


//Test
Route::post('/test/push', 'Student\ChatController@testPush');
Route::post('/test/responce', 'Student\ChatController@testResponse');
Route::post('/test/getResponce', 'Student\ChatController@testResponse1');


Route::get('/licence/check', 'LicenceController@check');


