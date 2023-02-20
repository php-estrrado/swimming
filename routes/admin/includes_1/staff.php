<?php

/* StaffController Routes Starts */
Route::group(['prefix' => 'admin', 'middleware' => ['authadmin:admin']], function() {
    
});
/* StaffController Routes Ends */
