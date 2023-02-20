<?php

/* ServiceController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('product/categories', 'ProductController@categories')->name('categories');
    Route::get('product/category/{id}', ['uses' => 'ProductController@category'], function($id) { })->where('id', '[0-9/]+');
    Route::post('product/category/status', 'ProductController@categoryStatus');
    Route::post('product/category/save', 'ProductController@saveCategory');
    Route::get('product/brands', 'ProductController@brands')->name('brands');
    Route::get('product/brand/{id}', ['uses' => 'ProductController@brand'], function($id) { })->where('id', '[0-9/]+');
     Route::post('product/brand/status', 'ProductController@brandStatus');
    Route::post('product/brand/save', 'ProductController@saveBrand');
    
});
/* ServiceController Routes Ends */
