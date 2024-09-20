<?php

namespace App\Providers;

use App\Classes\Contracts\Services\Admin\LanguageService as AdminLanguageServiceContract;
use App\Services\Admin\DashboardService;
use App\Services\Admin\LanguageService;
use App\Services\Admin\SectionService as AdminSectionService;
use App\Services\Admin\BrandService as AdminBrandService;
use App\Services\Admin\ProductService as AdminProductService;
use App\Services\Admin\GalleryService as AdminGalleryService;
use App\Services\Admin\SizeService as AdminSizeService;
use App\Services\Admin\ColorService as AdminColorService;
use App\Services\Admin\WishListService as AdminWishListService;
use App\Services\Admin\DealDayService as AdminDealDayService;
use App\Services\Admin\PopularByService as AdminPopularByService;
use App\Services\Admin\SlideService as AdminSlideService;
use App\Services\Admin\OrderService as AdminOrderService;
use App\Services\Admin\TagService as AdminTagServiceService;
use App\Services\Admin\SettingService as AdminSettingService;

use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\ProductReviewService;
use App\Services\ProductService;
use App\Services\UserService;
use App\Services\WishListService;
use App\Services\SectionService;
use App\Services\PopularByService;
use App\Services\OrderService;
use App\Services\DealDayService;
use App\Services\SizeService;
use App\Services\TagService;
use App\Services\SettingService;
use App\Classes\Contracts\Services\CategoryService as CategoryServiceContract;
use App\Classes\Contracts\Services\SectionService as SectionServiceContract;
use App\Classes\Contracts\Services\ProductService as ProductServiceContract;
use App\Classes\Contracts\Services\BrandService as BrandServiceContract;
use App\Classes\Contracts\Services\ColorService as ColorServiceContract;
use App\Classes\Contracts\Services\UserService as UserServiceContract;
use App\Classes\Contracts\Services\WishListService as WishListServiceContract;
use App\Classes\Contracts\Services\ProductReviewService as ProductReviewServiceContract;
use App\Classes\Contracts\Services\PopularByService as PopularByServiceContract;
use App\Classes\Contracts\Services\OrderService as OrderServiceContract;
use App\Classes\Contracts\Services\DealDayService as DealDayServiceContract;
use App\Classes\Contracts\Services\SizeService as SizeServiceContract;
use App\Classes\Contracts\Services\TagService as TagServiceContract;
use App\Classes\Contracts\Services\SettingService as SettingServiceContract;

use App\Classes\Contracts\Services\Admin\DashboardService as DashboardServiceServiceContract;
use App\Classes\Contracts\Services\Admin\SectionService as AdminSectionServiceContract;
use App\Classes\Contracts\Services\Admin\BrandService as AdminBrandServiceContract;
use App\Classes\Contracts\Services\Admin\ProductService as AdminProductServiceContract;
use App\Classes\Contracts\Services\Admin\GalleryService as AdminGalleryServiceContract;
use App\Classes\Contracts\Services\Admin\SizeService as AdminSizeServiceContract;
use App\Classes\Contracts\Services\Admin\ColorService as AdminColorServiceContract;
use App\Classes\Contracts\Services\Admin\WishListService as AdminWishListServiceContract;
use App\Classes\Contracts\Services\Admin\DealDayService as AdminDealDayServiceContract;
use App\Classes\Contracts\Services\Admin\PopularByService as AdminPopularByServiceContract;
use App\Classes\Contracts\Services\Admin\SlideService as AdminSlideServiceContract;
use App\Classes\Contracts\Services\Admin\OrderService as AdminOrderServiceContract;
use App\Classes\Contracts\Services\Admin\TagService as AdminTagServiceContract;
use App\Classes\Contracts\Services\Admin\SettingService as AdminSettingServiceContract;


use Illuminate\Pagination\Paginator;
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
        $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        $this->app->bind(SectionServiceContract::class, SectionService::class); //todo !!!
        $this->app->bind(ProductServiceContract::class, ProductService::class);
        $this->app->bind(BrandServiceContract::class, BrandService::class);
        $this->app->bind(ColorServiceContract::class, ColorService::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(WishListServiceContract::class, WishListService::class);
        $this->app->bind(ProductReviewServiceContract::class, ProductReviewService::class);
        $this->app->bind(DashboardServiceServiceContract::class, DashboardService::class);
        $this->app->bind(PopularByServiceContract::class, PopularByService::class);
        $this->app->bind(OrderServiceContract::class, OrderService::class);
        $this->app->bind(DealDayServiceContract::class, DealDayService::class);
        $this->app->bind(SizeServiceContract::class, SizeService::class);
        $this->app->bind(TagServiceContract::class, TagService::class);
        $this->app->bind(SettingServiceContract::class, SettingService::class);


        $this->app->bind(AdminSectionServiceContract::class, AdminSectionService::class);
        $this->app->bind(AdminBrandServiceContract::class, AdminBrandService::class);
        $this->app->bind(AdminProductServiceContract::class, AdminProductService::class);
        $this->app->bind(AdminGalleryServiceContract::class, AdminGalleryService::class);
        $this->app->bind(AdminSizeServiceContract::class, AdminSizeService::class);
        $this->app->bind(AdminColorServiceContract::class, AdminColorService::class);
        $this->app->bind(AdminWishListServiceContract::class, AdminWishListService::class);
        $this->app->bind(AdminDealDayServiceContract::class, AdminDealDayService::class);
        $this->app->bind(AdminPopularByServiceContract::class, AdminPopularByService::class);
        $this->app->bind(AdminSlideServiceContract::class, AdminSlideService::class);
        $this->app->bind(AdminOrderServiceContract::class, AdminOrderService::class);
        $this->app->bind(AdminTagServiceContract::class, AdminTagServiceService::class);
        $this->app->bind(AdminSettingServiceContract::class, AdminSettingService::class);
        $this->app->bind(AdminLanguageServiceContract::class, LanguageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
