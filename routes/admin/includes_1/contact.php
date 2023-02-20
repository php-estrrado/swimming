<?php

/* ContactController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('contacts', 'ContactController@showContacts')->name('contacts');
    Route::get('contact/view/{id}', array('uses' => 'ContactController@showContact'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::get('contact/delete/{id}', array('uses' => 'ContactController@deleteContact'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('contact/deleteall', array(
        'uses' => 'ContactController@deleteContacts'
    ));
});
/* ContactController Routes Ends */
