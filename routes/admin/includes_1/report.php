<?php

/* ReportController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::match(['get', 'post'], 'reports/owner/trial', 'ReportController@showTrialOwnersReport');
    Route::match(['get', 'post'], 'reports/owner/active', 'ReportController@showActiveOwnersReport');
});
/* ReportController Routes Ends */
