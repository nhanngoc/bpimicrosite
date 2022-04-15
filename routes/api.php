<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'middleware' => 'api',
    'prefix'     => 'v1',
    'namespace'  => 'API',
], function () {

    Route::group([
        'middleware' => 'auth.apikey',
    ], function () {

        // SO
        Route::get('sale-order/lists', 'SaleOrderApiController@getListSaleOrder');
        Route::put('sale-order/receive', 'SaleOrderApiController@receiveBill');
    });

});
