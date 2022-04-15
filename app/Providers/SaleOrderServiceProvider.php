<?php

namespace App\Providers;

use App\Models\ItemGroup;
use App\Models\MDGPartner;
use App\Models\MDGRemote;
use App\Models\SaleOrder;
use App\Models\SaleOrderInvoice;
use App\Models\SaleOrderItem;
use App\Models\SaleOrderResponse;
use App\models\SaleOrderSAP;
use App\Models\Tariff;
use App\Models\TariffItem;
use App\Repositories\ItemGroup\Caches\ItemGroupCacheDecorator;
use App\Repositories\ItemGroup\Eloquent\ItemGroupRepository;
use App\Repositories\ItemGroup\Interfaces\ItemGroupInterface;
use App\Repositories\MDGPartner\Eloquent\MDGPartnerRepository;
use App\Repositories\MDGRemote\Eloquent\MDGRemoteRepository;
use App\Repositories\MDGPartner\Interfaces\MDGPartnerInterface;
use App\Repositories\MDGRemote\Interfaces\MDGRemoteInterface;
use App\Repositories\SaleOrder\Caches\SaleOrderCacheDecorator;
use App\Repositories\SaleOrder\Caches\SaleOrderItemCacheDecorator;
use App\Repositories\SaleOrder\Caches\SaleOrderResponseCacheDecorator;
use App\Repositories\SaleOrder\Caches\SaleOrderSAPCacheDecorator;
use App\Repositories\SaleOrder\Eloquent\SaleOrderItemRepository;
use App\Repositories\SaleOrder\Eloquent\SaleOrderRepository;
use App\Repositories\SaleOrder\Eloquent\SaleOrderResponseRepository;
use App\Repositories\SaleOrder\Eloquent\SaleOrderSAPRepository;
use App\Repositories\SaleOrder\Interfaces\SaleOrderInterface;
use App\Repositories\SaleOrder\Interfaces\SaleOrderItemInterface;
use App\Repositories\SaleOrder\Interfaces\SaleOrderResponseInterface;
use App\Repositories\SaleOrder\Interfaces\SaleOrderSAPInterface;
use App\Repositories\SaleOrderInvoice\Eloquent\SaleOrderInvoiceRepository;
use App\Repositories\SaleOrderInvoice\Interfaces\SaleOrderInvoiceInterface;
use App\Repositories\Tariff\Caches\TariffCacheDecorator;
use App\Repositories\Tariff\Eloquent\TariffItemRepository;
use App\Repositories\Tariff\Eloquent\TariffRepository;
use App\Repositories\Tariff\Interfaces\TariffInterface;
use App\Repositories\Tariff\Interfaces\TariffItemInterface;
use Illuminate\Support\ServiceProvider;

class SaleOrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(SaleOrderInterface::class, function () {
            return new SaleOrderCacheDecorator(
                new SaleOrderRepository(
                    new SaleOrder
                )
            );
        });

        $this->app->bind(SaleOrderItemInterface::class, function () {
            return new SaleOrderItemCacheDecorator(
                new SaleOrderItemRepository(
                    new SaleOrderItem
                )
            );
        });

        $this->app->bind(SaleOrderResponseInterface::class, function () {
            return new SaleOrderResponseCacheDecorator(
                new SaleOrderResponseRepository(
                    new SaleOrderResponse
                )
            );
        });

        $this->app->bind(SaleOrderSAPInterface::class, function () {
            return new SaleOrderSAPCacheDecorator(
                new SaleOrderSAPRepository(
                    new SaleOrderSAP
                )
            );
        });

        $this->app->bind(TariffInterface::class, function () {
            return new TariffCacheDecorator(
                new TariffRepository(
                    new Tariff
                )
            );
        });
        $this->app->bind(TariffItemInterface::class, function () {
            return new TariffItemRepository(
                new TariffItem
            );
        });
        $this->app->bind(ItemGroupInterface::class, function () {
            return new ItemGroupCacheDecorator(
                new ItemGroupRepository(
                    new ItemGroup
                )
            );
        });

        $this->app->bind(MDGPartnerInterface::class, function () {
            return new MDGPartnerRepository(
                new MDGPartner
            );
        });

        $this->app->bind(MDGRemoteInterface::class, function () {
            return new MDGRemoteRepository(
                new MDGRemote
            );
        });

        $this->app->bind(SaleOrderInvoiceInterface::class, function () {
            return new SaleOrderInvoiceRepository(
                new SaleOrderInvoice
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
