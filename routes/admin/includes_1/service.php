<?php

/* ServiceController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('services/service', 'ServiceController@showServices')->name('services');
    Route::get('services/servicegroups', 'ServiceController@showServiceGroups')->name('servicegroups');
    Route::post('services/service/servicegroups', 'ServiceController@getServiceGroups');
    Route::post('services/service/save', 'ServiceController@saveService');
    Route::post('services/servicegroup/save', 'ServiceController@saveServiceGroup');
    Route::post('services/service/getservice', [
        'uses' => 'ServiceController@getService'
    ]);
    Route::post('services/servicegroup/getservicegroup', [
        'uses' => 'ServiceController@getServiceGroup'
    ]);
    Route::post('services/service/changestatus', [
        'uses' => 'ServiceController@changeServiceStatus'
    ]);
    Route::post('services/servicegroup/changestatus', [
        'uses' => 'ServiceController@changeServiceGroupStatus'
    ]);
    Route::get('services/service/delete/{id}', ['uses' => 'ServiceController@deleteService'], function($id) {
        
    })->where('id', '[0-9/]+');
    Route::get('services/servicegroup/delete/{id}', ['uses' => 'ServiceController@deleteServiceGroup'], function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('services/service/deleteall', [
        'uses' => 'ServiceController@deleteServices'
    ]);
    Route::post('services/servicegroup/deleteall', [
        'uses' => 'ServiceController@deleteServiceGroups'
    ]);
});
/* ServiceController Routes Ends */
