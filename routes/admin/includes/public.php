<?php

Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('adminlogin')->middleware('guest');
Route::post('admin/authenticate', array(
    'uses' => 'Auth\AdminLoginController@authenticate'
));
Route::get('admin/logout', array(
    'uses' => 'DashboardController@logout'
));

Route::get('admin/password/reset', 'Auth\AdminForgotPasswordController@showForgotPasswordForm')->name('forgotpassword')->middleware('guest');
Route::post('admin/sendresetlink', array(
    'uses' => 'Auth\AdminForgotPasswordController@sendResetPasswordLink'
));
Route::get('admin/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetPasswordForm')->name('resetpassword')->middleware('guest');
Route::post('admin/resetpassword', array(
    'uses' => 'Auth\AdminResetPasswordController@resetPassword'
));
