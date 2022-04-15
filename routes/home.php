<?php

//Route::resource('home', 'HomeController');
Route::get('/', [
    'as'         => 'home.index',
    'uses'       => 'HomeController@index',
    'permission' => false,
]);
Route::post('/post','HomeController@store')->name('customer.store');
  // Currency routes
/*   Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
    Route::resource('', 'CurrencyController')->parameters(['' => 'currency']);
}); */