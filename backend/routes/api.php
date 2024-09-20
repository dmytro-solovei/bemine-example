<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\PopularByController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DealDayController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TagController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('category/by-section/{section_id}', [CategoryController::class, 'getBySection']);
Route::get('category/by-parent/{section_id}', [CategoryController::class, 'getByParent']);
Route::get('category/parents', [CategoryController::class, 'getOnlyParents']); // may intersect with category/{category_id}
Route::get('category/brands', [CategoryController::class, 'getCategoryBrands']);
Route::get('category/sizes', [CategoryController::class, 'getCategorySizes']);
Route::get('category/{id}/subcategories', [CategoryController::class, 'getSubCategories']);
Route::get('product/by-slug/{slug}', [ProductController::class, 'getProductBySlug']);
Route::get('product/populars-by/', [PopularByController::class, 'index']);
Route::get('product/by-slide-group/{group}', [PopularByController::class, 'bySlideGroup']);
Route::get('product/by-ids', [ProductController::class, 'byIds']);

Route::resource('section', SectionController::class);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('brand', BrandController::class);
Route::resource('color', ColorController::class);
Route::resource('size', SizeController::class);
Route::resource('user', UserController::class);
Route::resource('wish-list', WishListController::class);
Route::resource('product-review', ProductReviewController::class);
Route::resource('order', OrderController::class)->only('store')->middleware('recaptcha');
Route::resource('deal-day', DealDayController::class)->only('index');
Route::resource('tag', TagController::class)->only('index');
Route::resource('setting', SettingController::class);


