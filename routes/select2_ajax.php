<?php

// Select2 ajax routes

Route::group([
    'prefix' => 'select2-ajax',
    'as'     => 'select2-ajax.'
], function () {
    Route::group(['prefix' => 'customer-vendor', 'as' => 'customer-vendor.'], function () {
        Route::get('get-by-search', 'Select2AjaxController@getSearchContactCode')->name('searchContactCode');
        Route::get('get-end-user', 'Select2AjaxController@getSearchEndUser')->name('searchEndUser');
    });

});