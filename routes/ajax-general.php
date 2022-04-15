<?php

// Ajax General (AG)


Route::group([
    'prefix' => 'ajax-general',
    'as'     => 'ajax-general.'
], function () {
    Route::get('business-type', 'AjaxGeneralController@getGeneralFromBusinessType')->name('get.businessType');
    Route::get('item-number/get-detail-by-item-no', 'AjaxGeneralController@getDetailItemNumberByCode')->name('get.DetailItemNo');
    Route::get('port-code/getIndex', 'PortCodeController@getAll')->name('get.portCodeIndex');
    Route::get('purchase-order/getIndex', 'PurchaseOrderController@getAll')->name('get.purchaseOrderIndex');
    Route::get('purchase-order/npo/getIndex', 'PurchaseOrderANSNonApprovalController@getAll')->name('get.purchaseOrderNPOIndex');
    Route::get('purchase-order/get-price-tariff', 'AjaxGeneralController@getPriceByTariff')->name('get.itemNumberPriceByTariff');

    Route::put('get-business-type', 'AjaxGeneralController@getBusinessTypeByTrade')->name('get-business-type');

});
