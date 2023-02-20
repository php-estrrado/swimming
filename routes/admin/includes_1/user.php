<?php

/* UserController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    Route::get('users/admin', 'UserController@showAdmins')->name('adminusers');
    //Route::get('users/owner', 'UserController@showOwners')->name('owners');
    Route::get('users/owner/trial', 'UserController@showTrialOwners')->name('trialowners');
    Route::get('users/owner/active', 'UserController@showActiveOwners')->name('activeowners');
    Route::get('users/customer', 'UserController@showCustomers')->name('customers');
    Route::get('users/admin/new', 'UserController@addAdminForm')->name('addadmin');
    Route::get('users/owner/new', 'UserController@addOwnerForm')->name('addowner');
    Route::get('users/customer/new', 'UserController@addCustomerForm')->name('addcustomer');
    Route::get('users/admin/view/{userid}', array('uses' => 'UserController@showAdmin'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/owner/view/{userid}', array('uses' => 'UserController@showOwner'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/customer/view/{userid}', array('uses' => 'UserController@showCustomer'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/admin/edit/{userid}', array('uses' => 'UserController@editAdminForm'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/owner/edit/{userid}', array('uses' => 'UserController@editOwnerForm'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/customer/edit/{userid}', array('uses' => 'UserController@editCustomerForm'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::get('users/owner/upgrade/{userid}', array('uses' => 'UserController@showUpgradeMembershipForm'), function($id) {
        
    })->where('userid', '[0-9]+');
    Route::post('users/admin/create', array(
        'uses' => 'UserController@createAdmin'
    ));
    Route::post('users/owner/create', array(
        'uses' => 'UserController@createOwner'
    ));
    Route::post('users/customer/create', array(
        'uses' => 'UserController@createCustomer'
    ));
    Route::post('users/admin/update', array(
        'uses' => 'UserController@updateAdmin'
    ));
    Route::post('users/owner/update', array(
        'uses' => 'UserController@updateOwner'
    ));
    Route::post('users/customer/update', array(
        'uses' => 'UserController@updateCustomer'
    ));
    Route::post('users/owner/upgrade/membership', array(
        'uses' => 'UserController@upgradeMembership'
    ));
    Route::post('users/owner/renew/membership', array(
        'uses' => 'UserController@renewMembership'
    ));
    Route::post('users/user/changestatus', array(
        'uses' => 'UserController@changeUserStatus'
    ));
    Route::post('users/user/delete', array(
        'uses' => 'UserController@deleteUser'
    ));
    Route::post('users/user/deleteall', array(
        'uses' => 'UserController@deleteUsers'
    ));
    Route::get('users/memberships', 'UserController@showMemberships')->name('memberships');
    Route::get('users/membership/{id}', array('uses' => 'UserController@showMembershipForm'), function($id) {
        
    })->where('id', '[a-z0-9/]+');
    Route::post('users/membership/save', 'UserController@saveMembership');
    Route::post('users/membership/changestatus', array(
        'uses' => 'UserController@changeMembershipStatus'
    ));
    Route::get('users/delete/membership/{id}', array('uses' => 'UserController@deleteMembership'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('users/membership/deleteall', array(
        'uses' => 'UserController@deleteMemberships'
    ));
    Route::post('users/owner/sendexpirymail', 'UserController@sendExpiryMail');
    Route::post('users/owner/sendexpirysms', 'UserController@sendExpirySms');
    Route::post('users/owner/callhistory/getcallhistory', array(
        'uses' => 'UserController@getCallHistory'
    ));
    Route::post('users/owner/callhistory/save', array(
        'uses' => 'UserController@saveCallHistory'
    ));
    Route::get('users/owner/callhistory/delete/{id}', array('uses' => 'UserController@deleteCallHistory'), function($id) {
        
    })->where('id', '[0-9/]+');
    Route::post('users/owner/callhistory/deleteall', array(
        'uses' => 'UserController@deleteAllCallHistory'
    ));
    Route::post('users/owner/staff/changestatus', array(
        'uses' => 'UserController@changeStaffStatus'
    ));
});
/* UserController Routes Ends */
