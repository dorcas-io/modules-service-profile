<?php

Route::group(['namespace' => 'Dorcas\ModulesServiceProfile\Http\Controllers', 'middleware' => ['web','auth']], function() {
    Route::get('service-profile-main', 'ModulesServiceProfileController@index')->name('service-profile-main');
});


?>