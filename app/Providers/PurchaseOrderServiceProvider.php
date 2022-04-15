<?php

namespace App\Providers;

use App\Models\PurchaseOrderSAP;
use App\Models\PurchaseOrderResponse;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderSAPRepository;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderSAPInterface;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderSAPCacheDecorator;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderResponseRepository;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderResponseInterface;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderResponseCacheDecorator;

class PurchaseOrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PurchaseOrderResponseInterface::class, function () {
            return new PurchaseOrderResponseCacheDecorator(
                new PurchaseOrderResponseRepository(
                    new PurchaseOrderResponse
                )
            );
        });

        $this->app->bind(PurchaseOrderSAPInterface::class, function () {
            return new PurchaseOrderSAPCacheDecorator(
                new PurchaseOrderSAPRepository(
                    new PurchaseOrderSAP
                )
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
