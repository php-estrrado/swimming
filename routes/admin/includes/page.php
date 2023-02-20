<?php

/* PageController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('pages/{id}', ['uses' => 'PageController@showPageForm'], function($id) {
        
    })->where('id', '[a-z0-9/]+');
    Route::post('pages/save', [
        'uses' => 'PageController@savePage'
    ]);
    Route::post('pages/widget/save', [
        'uses' => 'PageController@saveWidget'
    ]);
    Route::post('pages/banner/save', [
        'uses' => 'PageController@saveBanner'
    ]);
    Route::post('pages/widget/getwidget', [
        'uses' => 'PageController@getWidget'
    ]);
    Route::post('pages/banner/getbanner', [
        'uses' => 'PageController@getBanner'
    ]);
    Route::post('pages/banner/order/update', array(
        'uses' => 'PageController@updateBannerOrder'
    ));
    Route::post('pages/widget/order/update', array(
        'uses' => 'PageController@updateWidgetOrder'
    ));
    Route::post('pages/banner/changestatus', array(
        'uses' => 'PageController@changeBannerStatus'
    ));
    Route::post('pages/widget/changestatus', array(
        'uses' => 'PageController@changeWidgetStatus'
    ));
    Route::get('banner/pages/delete/{id}', array('uses' => 'PageController@deleteBanner'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('pages/banner/deleteall', array(
        'uses' => 'PageController@deleteBanners'
    ));
});
/* PageController Routes Ends */
