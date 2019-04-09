<?php

Route::group(['namespace' => 'Dorcas\ModulesServiceProfile\Http\Controllers', 'middleware' => ['web']], function() {
    Route::get('sales', 'ModulesServiceProfileController@index')->name('sales');
});


?>