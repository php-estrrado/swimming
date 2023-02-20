<?php

/* PaymentController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('payment/methods', 'PaymentController@paymentMethods')->name('payment_methods');
    Route::post('payment/method/save', 'PaymentController@saveMethod');
    Route::get('payment/method/{id}', ['uses' => 'PaymentController@paymentMethod'], function($id) { })->where('id', '[0-9/]+');
    Route::post('payment/method/status/{id}', ['uses' => 'PaymentController@statusMethod'], function($id) { })->where('id', '[0-9/]+');
    Route::get('payment/method/delete/{id}', ['uses' => 'PaymentController@deleteMethod'], function($id) { })->where('id', '[0-9/]+');
});
/* PaymentController Routes Ends */
