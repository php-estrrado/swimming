<?php
Route::group(['prefix' => 'coach'], function() {
    Route::get('/messages', 'Coach\MessageController@index');
    Route::get('messages/{id}', ['uses' => 'Coach\MessageController@index'], function($id) { })->where('id', '[0-9/]+');
    Route::get('message/{id}', ['uses' => 'Coach\MessageController@message'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/message/save', 'Coach\MessageController@save');
    Route::post('/new/messages', 'Coach\MessageController@getMessage');
    Route::post('/message/create/{id}', ['uses' => 'Coach\MessageController@createMessage'], function($id) { })->where('id', '[0-9/]+');
});