<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DealDayController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PopularByController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SlidesController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes(['login' => false,'register' => false]);
Route::get('/dsfgsfghzxdfgzdfhzdgv', [LoginController::class, 'showAdminLoginForm']);
Route::post('/dsfgsfghzxdfgzdfhzdgv', [LoginController::class, 'adminLogin'])->name('dsfgsfghzxdfgzdfhzdgv');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dsfgsfghzxdfgzdfhzdgv', 'middleware' => ['auth:admin', 'throttle:limitadmin']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/users', UserController::class)->except('show');
    Route::resource('/section', SectionController::class)->except('show');
    Route::resource('/brand', BrandController::class)->except('show');
    Route::resource('/product', ProductController::class)->except('show');
    Route::get('/product/{id}/edit/{page}', [ProductController::class, 'edit']);

    Route::resource('/size', SizeController::class)->except('show');
    Route::resource('/color', ColorController::class)->except('show');
    Route::resource('/deal-day', DealDayController::class)->except('show');
    Route::resource('/popular-by', PopularByController::class)->except('show');
    Route::resource('/slide', SlidesController::class)->except('show');
    Route::resource('/order', OrderController::class)->only('index', 'show');
    Route::resource('/tag', TagController::class);
    Route::resource('/setting', SettingController::class)->except('show');
    Route::resource('/language', LanguageController::class);
    Route::post('/language/all', [LanguageController::class, 'getAllLanguages']);


    Route::post('/product/gallery', [GalleryController::class, 'deleteProductGallery']);
    Route::post('/product/gallery', [GalleryController::class, 'deleteProductGallery']);
    Route::post('/product/gallery/photo', [GalleryController::class, 'removeGalleryPhoto']);
    Route::post('/product/add-gallery/block/{gallery_count}/{size_count}', [GalleryController::class, 'addGalleryBlock']);
    Route::post('/product/add-color-size/block/{gallery_count}/{size_block_count}', [GalleryController::class, 'addColorSizeBlock']);
    Route::put('/product/inactive/{product_id}', [ProductController::class, 'inactive'])->name('product.inactive');
    Route::put('/brand/inactive/{brand_id}', [BrandController::class, 'inactive'])->name('brand.inactive');
    Route::put('/tag/inactive/{tag_id}', [TagController::class, 'inactive'])->name('tag.inactive');
    Route::post('/deal-day/add-block/{deal_day_count}', [DealDayController::class, 'addBlock']);
    Route::post('/product/add-additional/block', [ProductController::class, 'addAdditionalBlock']);
    Route::post('/product/add-information/block/{block}', [ProductController::class, 'addInformationBlock']);
    Route::put('/order/change-status', [OrderController::class, 'changeOrderStatus'])->name('change-order-status');
    Route::post('/section/add/edit/block/{id}', [SectionController::class, 'addSectionEditBlock']);
    Route::post('/section/add/create/block', [SectionController::class, 'addSectionCreateBlock']);
});

