<?php

/* SettingsController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('settings/emails', 'SettingsController@showEmailTemplates')->name('emailtemplate');
    Route::get('settings/smstemplates', 'SettingsController@showSmsTemplates')->name('smstemplate');
    Route::get('settings/faqs', 'SettingsController@showFaqs')->name('faqs');
    Route::get('settings/smscredits', 'SettingsController@showSmsCredits')->name('smscredits');
    Route::get('settings/prints', 'SettingsController@prints')->name('print_templates');
    Route::get('settings/print/{id}', array('uses' => 'SettingsController@printTemplate'), function($sId) { })->where('id','[0-9/]+')->name('print_template');
    Route::post('settings/print/save', 'SettingsController@savePrint');
    Route::get('settings/print/status/{id}', ['uses' => 'SettingsController@printStatus'], function($id) { })->where('id', '[0-9/]+');
    Route::get('settings/print/delete/{id}', ['uses' => 'SettingsController@deletePrint'], function($id) { })->where('id', '[0-9/]+');
    Route::get('settings/email/{id}', array('uses' => 'SettingsController@showEmailTemplateForm'), function($id) {
        
    })->where('id', '[a-z0-9/]+');
    Route::get('settings/sms/{id}', array('uses' => 'SettingsController@showSmsTemplateForm'), function($id) {
        
    })->where('id', '[a-z0-9/]+');
    Route::get('settings/faq/{id}', array('uses' => 'SettingsController@showFaqForm'), function($id) {
        
    })->where('id', '[a-z0-9/]+');
    Route::post('settings/smspackagedetails/get', array(
        'uses' => 'SettingsController@getSmsPackageDetails'
    ));
    Route::post('settings/smsrequest/get', array(
        'uses' => 'SettingsController@getSmsRequest'
    ));
    Route::post('settings/email/save', array(
        'uses' => 'SettingsController@saveEmailTemplate'
    ));
    Route::post('settings/sms/save', array(
        'uses' => 'SettingsController@saveSmsTemplate'
    ));
    Route::post('settings/smspackagedetails/save', array(
        'uses' => 'SettingsController@saveSmsPackageDetails'
    ));
    Route::post('settings/sms/assign', array(
        'uses' => 'SettingsController@assignSmsUsers'
    ));
    Route::post('settings/email/assign', array(
        'uses' => 'SettingsController@assignEmailUsers'
    ));
    Route::post('settings/faq/save', array(
        'uses' => 'SettingsController@saveFaq'
    ));
    Route::post('settings/editor/image/upload', array(
        'uses' => 'SettingsController@uploadEditorImage'
    ));
    Route::post('settings/faq/order/update', array(
        'uses' => 'SettingsController@updateFaqOrder'
    ));
    Route::post('settings/email/changestatus', array(
        'uses' => 'SettingsController@changeEmailStatus'
    ));
    Route::post('settings/sms/changestatus', array(
        'uses' => 'SettingsController@changeSmsStatus'
    ));
    Route::post('settings/faq/changestatus', array(
        'uses' => 'SettingsController@changeFaqStatus'
    ));
    Route::post('settings/smspackagedetails/changestatus', array(
        'uses' => 'SettingsController@changeSmsPackageStatus'
    ));
    Route::post('settings/smscredits/approve', array(
        'uses' => 'SettingsController@approveSmsRequest'
    ));
    Route::get('settings/delete/email/{id}', array('uses' => 'SettingsController@deleteEmailTemplate'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::get('settings/delete/sms/{id}', array('uses' => 'SettingsController@deleteSmsTemplate'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::get('settings/delete/faq/{id}', array('uses' => 'SettingsController@deleteFaq'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::get('settings/delete/spd/{id}', array('uses' => 'SettingsController@deleteSmsPackageDetail'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('settings/email/deleteall', array(
        'uses' => 'SettingsController@deleteEmailTemplates'
    ));
    Route::post('settings/sms/deleteall', array(
        'uses' => 'SettingsController@deleteSmsTemplates'
    ));
    Route::post('settings/faq/deleteall', array(
        'uses' => 'SettingsController@deleteFaqs'
    ));
    Route::post('settings/smspackagedetails/deleteall', array(
        'uses' => 'SettingsController@deleteSmsPackageDetails'
    ));
});
/* SettingsController Routes Ends */
