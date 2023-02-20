<?php
Route::group(['prefix' => 'coach'], function() {
    Route::get('/students', 'Coach\StudentController@students');
    Route::get('student/{id}/{sid}/{aid}', ['uses' => 'Coach\StudentController@studSubmitActivity'], function($id,$sid,$aid) { })->where(['id'=>'[0-9/]+','sid'=>'[0-9/]+','aid'=>'[0-9/]+']);
    Route::get('student/{id}/{sid}', ['uses' => 'Coach\StudentController@courseStudent'], function($id,$sid) { })->where('id', '[0-9/]+')->where('sid', '[0-9/]+');
    Route::get('student/{id}', ['uses' => 'Coach\StudentController@student'], function($id) { })->where('id', '[0-9/]+');
    
    Route::post('/update/course/percent', 'Coach\StudentController@updatePercent');
});