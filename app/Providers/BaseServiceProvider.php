<?php

namespace App\Providers;

use App\Facades\CancelSapFacade;
use App\Models\ItemGroup;
use App\Models\UOM;
use App\Models\Role;
use App\Models\User;
use App\Models\Period;
use App\Models\Setting;
use App\Models\TaxCode;
use App\Models\PortCode;
use App\Models\Customer;
use App\Models\CargoType;
use App\Models\Incoterms;
use App\Models\PlantCode;
use App\Models\TradeType;
use App\Models\UserGroup;
use App\Models\Activation;
use App\Models\ChargeCode;
use App\Models\Department;
use App\Models\ItemNumber;
use App\Models\PostingKey;
use App\Models\RegionCode;
use App\Models\CompanyCode;
use App\Models\PaymentTerm;
use App\Core\Support\Helper;
use App\Models\AuditHistory;
use App\Models\BusinessArea;
use App\Models\BusinessType;
use App\Models\DocumentType;
use App\Models\LocationCode;
use App\Models\MaterialCode;
use App\Facades\ApiSapFacade;
use App\Models\PurchaseOrder;
use App\Models\PurchasingOrg;
use App\Facades\AuditLogFacade;
use App\Models\CompanyInternal;
use App\Models\PurchaseOrderANS;
use App\Facades\AclManagerFacade;
use App\Models\PurchaseOrderItem;
use App\Models\PurchasingDocType;
use App\Models\PurchaseOrderANSItem;
use App\Repositories\ItemNumber\Caches\ItemNumberCacheDecorator;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResourceRegistrar;
use App\Http\Middleware\Admin\Authenticate;
use App\Repositories\UOM\Eloquent\UOMRepository;
use App\Repositories\Acl\Eloquent\RoleRepository;
use App\Repositories\Acl\Eloquent\UserRepository;
use App\Repositories\UOM\Interfaces\UOMInterface;
use App\Repositories\Acl\Interfaces\RoleInterface;
use App\Repositories\Acl\Interfaces\UserInterface;
use App\Repositories\UOM\Caches\UOMCacheDecorator;
use App\Repositories\Acl\Caches\RoleCacheDecorator;
use App\Core\Support\Routes\CustomResourceRegistrar;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use App\Repositories\Period\Eloquent\PeriodRepository;
use App\Repositories\Acl\Eloquent\ActivationRepository;
use App\Repositories\Period\Interfaces\PeriodInterface;
use App\Repositories\Acl\Interfaces\ActivationInterface;
use App\Repositories\Period\Caches\PeriodCacheDecorator;
use App\Repositories\Setting\Eloquent\SettingRepository;
use App\Repositories\TaxCode\Eloquent\TaxCodeRepository;
use App\Repositories\Setting\Interfaces\SettingInterface;
use App\Repositories\TaxCode\Interfaces\TaxCodeInterface;
use App\Repositories\PortCode\Eloquent\PortCodeRepository;

use App\Repositories\Customer\Eloquent\CustomerRepository;
use App\Repositories\Customer\Interfaces\CustomerInterface;
use App\Repositories\Customer\Caches\CustomerCacheDecorator;
use App\Repositories\Setting\Caches\SettingCacheDecorator;
use App\Repositories\TaxCode\Caches\TaxCodeCacheDecorator;
use App\Repositories\PortCode\Interfaces\PortCodeInterface;
use App\Repositories\CargoType\Eloquent\CargoTypeRepository;
use App\Repositories\Incoterms\Eloquent\IncotermsRepository;
use App\Repositories\PlantCode\Eloquent\PlantCodeRepository;
use App\Repositories\PortCode\Caches\PortCodeCacheDecorator;
use App\Repositories\TradeType\Eloquent\TradeTypeRepository;
use App\Repositories\UserGroup\Eloquent\UserGroupRepository;
use App\Repositories\CargoType\Interfaces\CargoTypeInterface;
use App\Repositories\Incoterms\Interfaces\IncotermsInterface;
use App\Repositories\PlantCode\Interfaces\PlantCodeInterface;
use App\Repositories\TradeType\Interfaces\TradeTypeInterface;
use App\Repositories\UserGroup\Interfaces\UserGroupInterface;
use App\Repositories\CargoType\Caches\CargoTypeCacheDecorator;
use App\Repositories\ChargeCode\Eloquent\ChargeCodeRepository;
use App\Repositories\Department\Eloquent\DepartmentRepository;
use App\Repositories\Incoterms\Caches\IncotermsCacheDecorator;
use App\Repositories\ItemNumber\Eloquent\ItemNumberRepository;
use App\Repositories\PlantCode\Caches\PlantCodeCacheDecorator;
use App\Repositories\PostingKey\Eloquent\PostingKeyRepository;
use App\Repositories\RegionCode\Eloquent\RegionCodeRepository;
use App\Repositories\TradeType\Caches\TradeTypeCacheDecorator;
use App\Repositories\UserGroup\Caches\UserGroupCacheDecorator;
use App\Repositories\ChargeCode\Interfaces\ChargeCodeInterface;
use App\Repositories\Department\Interfaces\DepartmentInterface;
use App\Repositories\ItemNumber\Interfaces\ItemNumberInterface;
use App\Repositories\PostingKey\Interfaces\PostingKeyInterface;
use App\Repositories\RegionCode\Interfaces\RegionCodeInterface;
use App\Repositories\ChargeCode\Caches\ChargeCodeCacheDecorator;
use App\Repositories\CompanyCode\Eloquent\CompanyCodeRepository;
use App\Repositories\Department\Caches\DepartmentCacheDecorator;
use App\Repositories\ItemGroup\Caches\ItemGroupCacheDecorator;
use App\Repositories\PaymentTerm\Eloquent\PaymentTermRepository;
use App\Repositories\PostingKey\Caches\PostingKeyCacheDecorator;
use App\Repositories\RegionCode\Caches\RegionCodeCacheDecorator;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;
use App\Repositories\PaymentTerm\Interfaces\PaymentTermInterface;
use App\Repositories\AuditHistory\Eloquent\AuditHistoryRepository;
use App\Repositories\BusinessArea\Eloquent\BusinessAreaRepository;
use App\Repositories\BusinessType\Eloquent\BusinessTypeRepository;
use App\Repositories\CompanyCode\Caches\CompanyCodeCacheDecorator;
use App\Repositories\DocumentType\Eloquent\DocumentTypeRepository;
use App\Repositories\LocationCode\Eloquent\LocationCodeRepository;
use App\Repositories\MaterialCode\Eloquent\MaterialCodeRepository;
use App\Repositories\PaymentTerm\Caches\PaymentTermCacheDecorator;
use App\Repositories\AuditHistory\Interfaces\AuditHistoryInterface;
use App\Repositories\BusinessArea\Interfaces\BusinessAreaInterface;
use App\Repositories\BusinessType\Interfaces\BusinessTypeInterface;
use App\Repositories\DocumentType\Interfaces\DocumentTypeInterface;
use App\Repositories\LocationCode\Interfaces\LocationCodeInterface;
use App\Repositories\MaterialCode\Interfaces\MaterialCodeInterface;
use App\Repositories\AuditHistory\Caches\AuditHistoryCacheDecorator;
use App\Repositories\BusinessArea\Caches\BusinessAreaCacheDecorator;
use App\Repositories\BusinessType\Caches\BusinessTypeCacheDecorator;
use App\Repositories\DocumentType\Caches\DocumentTypeCacheDecorator;
use App\Repositories\LocationCode\Caches\LocationCodeCacheDecorator;
use App\Repositories\MaterialCode\Caches\MaterialCodeCacheDecorator;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderRepository;
use App\Repositories\PurchasingOrg\Eloquent\PurchasingOrgRepository;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderInterface;
use App\Repositories\PurchasingOrg\Interfaces\PurchasingOrgInterface;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderCacheDecorator;
use App\Repositories\PurchasingOrg\Caches\PurchasingOrgCacheDecorator;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderANSRepository;
use App\Repositories\CompanyInternal\Eloquent\CompanyInternalRepository;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderItemRepository;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderANSInterface;
use App\Repositories\CompanyInternal\Interfaces\CompanyInternalInterface;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderANSCacheDecorator;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderItemInterface;
use App\Repositories\CompanyInternal\Caches\CompanyInternalCacheDecorator;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderItemCacheDecorator;
use App\Repositories\PurchaseOrder\Eloquent\PurchaseOrderANSItemRepository;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderANSItemInterface;
use App\Repositories\PurchasingDocType\Eloquent\PurchasingDocTypeRepository;
use App\Repositories\PurchaseOrder\Caches\PurchaseOrderANSItemCacheDecorator;
use App\Repositories\PurchasingDocType\Interfaces\PurchasingDocTypeInterface;
use App\Repositories\PurchasingDocType\Caches\PurchasingDocTypeCacheDecorator;

class BaseServiceProvider extends ServiceProvider
{
    protected $app;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResourceRegistrar::class, function ($app) {
            return new CustomResourceRegistrar($app['router']);
        });
        $router = $this->app['router'];

        $router->aliasMiddleware('admin', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);

        AliasLoader::getInstance()->alias('AuditLog', AuditLogFacade::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('AclManager', AclManagerFacade::class);
        $loader->alias('ApiSap', ApiSapFacade::class);
        $loader->alias('CancelSap', CancelSapFacade::class);

        $this->app->bind(SettingInterface::class, function () {
            return new SettingCacheDecorator(new SettingRepository(new Setting));
        });

        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User);
        });

        $this->app->bind(ActivationInterface::class, function () {
            return new ActivationRepository(new Activation);
        });

        $this->app->bind(RoleInterface::class, function () {
            return new RoleCacheDecorator(new RoleRepository(new Role));
        });

        $this->app->bind(AuditHistoryInterface::class, function () {
            return new AuditHistoryCacheDecorator(new AuditHistoryRepository(new AuditHistory));
        });
        //


        $this->app->bind(PlantCodeInterface::class, function () {
            return new PlantCodeCacheDecorator(
                new PlantCodeRepository(
                    new PlantCode
                )
            );
        });

        $this->app->bind(PaymentTermInterface::class, function () {
            return new PaymentTermCacheDecorator(
                new PaymentTermRepository(
                    new PaymentTerm
                )
            );
        });

        $this->app->bind(PurchasingOrgInterface::class, function () {
            return new PurchasingOrgCacheDecorator(
                new PurchasingOrgRepository(
                    new PurchasingOrg
                )
            );
        });

        $this->app->bind(BusinessTypeInterface::class, function () {
            return new BusinessTypeCacheDecorator(
                new BusinessTypeRepository(
                    new BusinessType
                )
            );
        });

        $this->app->bind(PurchasingDocTypeInterface::class, function () {
            return new PurchasingDocTypeCacheDecorator(
                new PurchasingDocTypeRepository(
                    new PurchasingDocType
                )
            );
        });

        $this->app->bind(DocumentTypeInterface::class, function () {
            return new DocumentTypeCacheDecorator(
                new DocumentTypeRepository(
                    new DocumentType
                )
            );
        });

        $this->app->bind(CargoTypeInterface::class, function () {
            return new CargoTypeCacheDecorator(
                new CargoTypeRepository(
                    new CargoType
                )
            );
        });

        $this->app->bind(TradeTypeInterface::class, function () {
            return new TradeTypeCacheDecorator(
                new TradeTypeRepository(
                    new TradeType
                )
            );
        });

        $this->app->bind(IncotermsInterface::class, function () {
            return new IncotermsCacheDecorator(
                new IncotermsRepository(
                    new Incoterms
                )
            );
        });

        $this->app->bind(MaterialCodeInterface::class, function () {
            return new MaterialCodeCacheDecorator(
                new MaterialCodeRepository(
                    new MaterialCode
                )
            );
        });

        $this->app->bind(TaxCodeInterface::class, function () {
            return new TaxCodeCacheDecorator(
                new TaxCodeRepository(
                    new TaxCode
                )
            );
        });

        $this->app->bind(CompanyInternalInterface::class, function () {
            return new CompanyInternalCacheDecorator(
                new CompanyInternalRepository(
                    new CompanyInternal
                )
            );
        });

        $this->app->bind(DepartmentInterface::class, function () {
            return new DepartmentCacheDecorator(
                new DepartmentRepository(
                    new Department
                )
            );
        });

        $this->app->bind(UserGroupInterface::class, function () {
            return new UserGroupCacheDecorator(
                new UserGroupRepository(
                    new UserGroup
                )
            );
        });
        $this->app->bind(PortCodeInterface::class, function () {
            return new PortCodeCacheDecorator(
                new PortCodeRepository(
                    new PortCode
                )
            );
        });


        $this->app->bind(CustomerInterface::class, function () {
            return new CustomerCacheDecorator(
                new CustomerRepository(
                    new Customer
                )
            );
        });


        $this->app->bind(PostingKeyInterface::class, function () {
            return new PostingKeyCacheDecorator(
                new PostingKeyRepository(
                    new PostingKey
                )
            );
        });

        $this->app->bind(RegionCodeInterface::class, function () {
            return new RegionCodeCacheDecorator(
                new RegionCodeRepository(
                    new RegionCode
                )
            );
        });

        $this->app->bind(LocationCodeInterface::class, function () {
            return new LocationCodeCacheDecorator(
                new LocationCodeRepository(
                    new LocationCode
                )
            );
        });

        $this->app->bind(PurchaseOrderInterface::class, function () {
            return new PurchaseOrderCacheDecorator(
                new PurchaseOrderRepository(
                    new PurchaseOrder
                )
            );
        });

        $this->app->bind(PurchaseOrderItemInterface::class, function () {
            return new PurchaseOrderItemCacheDecorator(
                new PurchaseOrderItemRepository(
                    new PurchaseOrderItem
                )
            );
        });

        $this->app->bind(CompanyCodeInterface::class, function () {
            return new CompanyCodeCacheDecorator(
                new CompanyCodeRepository(
                    new CompanyCode
                )
            );
        });

        $this->app->bind(PurchaseOrderANSInterface::class, function () {
            return new PurchaseOrderANSCacheDecorator(
                new PurchaseOrderANSRepository(new  PurchaseOrderANS)
            );
        });

        $this->app->bind(PurchaseOrderANSItemInterface::class, function () {
            return new PurchaseOrderANSItemCacheDecorator(
                new PurchaseOrderANSItemRepository(
                    new PurchaseOrderANSItem
                )
            );
        });
        $this->app->bind(UOMInterface::class, function () {
            return new UOMCacheDecorator(
                new UOMRepository(
                    new UOM
                )
            );
        });

        $this->app->bind(ChargeCodeInterface::class, function () {
            return new ChargeCodeCacheDecorator(
                new ChargeCodeRepository(
                    new ChargeCode
                )
            );
        });

        $this->app->bind(BusinessAreaInterface::class, function () {
            return new BusinessAreaCacheDecorator(
                new BusinessAreaRepository(
                    new BusinessArea
                )
            );
        });

        $this->app->bind(PeriodInterface::class, function () {
            return new PeriodCacheDecorator(
                new PeriodRepository(
                    new Period
                )
            );
        });

        $this->app->bind(ItemNumberInterface::class, function () {
            return new ItemNumberCacheDecorator(
                new ItemNumberRepository(
                    new ItemNumber
                )
            );
        });

        Helper::autoload(__DIR__ . '/../Helpers');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->register(PurchaseOrderServiceProvider::class);
        $this->app->register(SaleOrderServiceProvider::class);
        $this->app->register(ApiKeyServiceProvider::class);
    }
}
