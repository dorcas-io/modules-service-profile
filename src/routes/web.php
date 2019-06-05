<?php

Route::group(['namespace' => 'Dorcas\ModulesServiceProfile\Http\Controllers', 'middleware' => ['web','auth'], 'prefix' => 'mpp'], function() {
    Route::get('service-profile-main', 'ModulesServiceProfileController@index')->name('service-profile-main')->middleware('professional_only');
    Route::post('service-profile-main', 'ModulesServiceProfileController@post')->middleware('professional_only');
    //Route::get('/profile', 'Profile@index')->name('directory.profile');
    //Route::post('/profile', 'Profile@post')->middleware('professional_only');
});


?>