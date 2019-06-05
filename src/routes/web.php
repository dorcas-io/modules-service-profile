<?php

Route::group(['namespace' => 'Dorcas\ModulesServiceProfile\Http\Controllers', 'middleware' => ['web','auth'], 'prefix' => 'mpp'], function() {
    Route::get('service-profile-main', 'ModulesServiceProfileController@index')->name('service-profile-main')->middleware('professional_only');
    Route::post('service-profile-main', 'ModulesServiceProfileController@post')->middleware('professional_only');

    Route::post('/credentials', 'ModulesServiceProfileController@addCredential');
    Route::delete('/credentials/{id}', 'ModulesServiceProfileController@deleteCredential');
    Route::post('/experiences', 'ModulesServiceProfileController@addExperience');
    Route::delete('/experiences/{id}', 'ModulesServiceProfileController@deleteExperience');
    Route::post('/services', 'ModulesServiceProfileController@manageServices');
    Route::delete('/services/{id}', 'ModulesServiceProfileController@deleteService');
    Route::delete('/social-connections', 'ModulesServiceProfileController@deleteSocialConnection');
    Route::post('/social-connections', 'ModulesServiceProfileController@addSocialConnection');

});


?>