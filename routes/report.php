<?php

Route::group([
    'prefix' => 'general-report',
    'as'     => 'general_report.'
], function () {
    Route::get('revenue', 'GeneralReportController@getRevenue')->name('revenue');
    Route::put('revenue', 'GeneralReportController@getRevenue')->name('postRevenue');
});
