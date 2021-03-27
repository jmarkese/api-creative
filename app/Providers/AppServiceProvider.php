<?php

namespace App\Providers;

use App\OutputFormatters\IOutputFormatterFactory;
use App\OutputFormatters\OutputFormatterFactory;
use App\Services\CreativeService;
use App\Services\Interfaces\ICreativeService;
use App\Services\Interfaces\IOrderLineItemService;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IProductTypeService;
use App\Services\Interfaces\IProductTypeVendorService;
use App\Services\Interfaces\IVendorService;
use App\Services\OrderLineItemService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\ProductTypeService;
use App\Services\ProductTypeVendorService;
use App\Services\VendorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICreativeService::class, CreativeService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IOrderLineItemService::class, OrderLineItemService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IProductTypeService::class, ProductTypeService::class);
        $this->app->bind(IProductTypeVendorService::class, ProductTypeVendorService::class);
        $this->app->bind(IVendorService::class, VendorService::class);
        $this->app->bind(IOutputFormatterFactory::class, OutputFormatterFactory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
