<?php
/*
  | Web Routes
  |--------------------------------------------------------------------------
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
 */

Route::get('/', 'HomeController@index')->name('home');
Route::get('/shop/cron/service/reminder','CronController@serviceAptReminder');
Route::get('/shop/cron/package/reminder','CronController@servicePackReminder');

Route::post('/user/register', 'UserController@create')->name('register');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/location', 'HomeController@location')->name('location');
Route::get('/course', 'HomeController@course')->name('course');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/saveContact', 'HomeController@saveContact');

Route::get('/account/activate/{token}', 'UserController@accountActivate');
Route::post('/forgot/password', 'UserController@forgotPassword');
Route::get('/reset/password/{token}', 'UserController@resetPassword');
Route::post('/update/password', 'UserController@updatePassword');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth:web']], function() {
    foreach (glob(__DIR__ . '/includes/*.php') as $filename) {
        require_once($filename);
    }
    Route::get('/coach', 'Coach\CoachController@index'); Route::get('/coach/dashboard', 'Coach\CoachController@index');
    Route::post('/coach/update/notify', 'Coach\CoachController@updateNotify');
    Route::get('/coach/profile', 'Coach\CoachController@profile');
    Route::post('/coach/profile/update', 'Coach\CoachController@updateProfile');
});

Route::post('/test/responce', 'HomeController@testResponse');
Route::get('/instapage/response1', 'TestController@response1');
