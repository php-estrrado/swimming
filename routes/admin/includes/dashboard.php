<?php

/* DashboardController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('/', 'DashboardController@showDashboard')->name('admindashboard');
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile/update', 'DashboardController@updateProfile');
});
/* DashboardController Routes Ends */
