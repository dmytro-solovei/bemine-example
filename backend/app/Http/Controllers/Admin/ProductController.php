<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\ColorService;
use App\Classes\Contracts\Services\Admin\ProductService;
use App\Classes\Contracts\Services\Admin\SizeService;
use App\Classes\Contracts\Services\Admin\SlideService;
use App\Classes\Contracts\Services\Admin\TagService;
use App\Classes\Dto\Admin\ProductDto;
use App\Classes\Enum\ProductAvailableEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductIndexRequest;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Brand;
use App\Classes\Contracts\Services\Admin\BrandService;
use App\Models\Product;
use App\Models\Section;
use App\Services\Admin\SectionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Controllers\Admin
 *
 */
class ProductController extends Controller
{

    /**
     * @var ProductService
     */
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(ProductIndexRequest $request)
    {
        $products = $this->productService->getAllProducts(false, [
            'filter_popular_by' => $request->filter_popular_by,
            'search' => $request->search
        ]);

        return view('admin.products.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $brandService = app(BrandService::class);
        $brands = $brandService->getAllBrands(true);
        $sizeService = app(SizeService::class);
        $sizes = $sizeService->getAllSizes();
        $colorService = app(ColorService::class);
        $colors = $colorService->getAllColors();
        $sectionService = app(SectionService::class);
        $sections = $sectionService->getAllSections(true);
        $tagsService = app(TagService::class);
        $tags = $tagsService->getAllTags(true);
        $productSortBigCount = $this->productService->getProductSortIsBigCount();

        return view('admin.products.create', compact('brands', 'sizes', 'colors', 'sections', 'tags', 'productSortBigCount'));
    }

    /**
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $brand = Brand::findOrFail($request->brand);

        $this->productService->saveProduct(


            new ProductDto([
                'title' => $request->title,
                'brand' => $brand,
                'file' => $request->avatar,
                'old_price' => (double)$request->old_price,
                'price' => (float)$request->price,
                'stars_rate' => (int) $request->stars_rate,
                'viewed' => (int)$request->viewed,
                'description' => $request->description,
                'active' => (bool)$request->active,
                'gallery' => $request->gallery,
                'sections' => $request->sections,
                'tags' => $request->tags,
                'sort' => (int)$request->sort,
            ])
        );

        return redirect()->route('product.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id, int $page)
    {
        $brandService = app(BrandService::class);
        $brands = $brandService->getAllBrands(true);
        $product = Product::with([
            'productProperties.size', 'productProperties.color', 'popularsBy', 'productDetails', 'sections', 'suggestedProducts'
        ])->with(['gallery' => function (HasMany $builder) {
            $builder->small()->with('properties');
        }])->findOrFail($id);

        $editData = $this->productService->getEditData($product);

        $sizeService = app(SizeService::class);
        $sizes = $sizeService->getAllSizes();
        $colorService = app(ColorService::class);
        $colors = $colorService->getAllColors();
        $slideService = app(SlideService::class);
        $slides = $slideService->getAllSlides();
        $availabilities = ProductAvailableEnum::toArray();
        $sectionService = app(SectionService::class);
        $sections = $sectionService->getAllSections(true);
        $tagsService = app(TagService::class);
        $tags = $tagsService->getAllTags(true);
        $productService = app(ProductService::class);
        $allProducts = $productService->getAllProducts(true);

        return view('admin.products.edit',
            compact('product', 'brands', 'sizes', 'colors', 'editData', 'slides', 'availabilities','sections', 'tags', 'allProducts', 'page')
        );
    }

    /**
     * @param ProductUpdateRequest $request
     * @param int $productId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(ProductUpdateRequest $request, int $productId): RedirectResponse
    {
        $brand = Brand::findOrFail($request->brand);
        $product = Product::findOrFail($productId);

        $this->productService->updateProduct(

            new ProductDto([
                'title' => $request->title,
                'brand' => $brand,
                'file' => $request->avatar,
                'old_price' => (float)$request->old_price,
                'price' => (float)$request->price,
                'viewed' => (int)$request->viewed,
                'description' => $request->description,
                'stars_rate' => (int)$request->stars_rate,
                'active' => (bool)$request->active,
                'gallery' => $request->gallery,
                'existing_gallery' => $request->existing_gallery,
                'popular_by' => $request->popular_by,
                'slide_groups' => $request->slide_groups,
                'additional' => $request->additional,
                'information' => $request->information,
                'available' => $request->available,
                'sections' => $request->sections,
                'tags' => $request->tags,
                'suggested_products' => $request->suggested_products,
                'sort' => (int)$request->sort,
            ]),
            $product
        );

        return redirect()->route('product.index', ['page' => $request->page]);
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function destroy(int $productId): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        $this->productService->deleteProduct($product);

        return redirect()->route('product.index');
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function inactive(int $productId): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        $this->productService->toggleActive($product);

        return redirect()->route('product.index');
    }

    /**
     * @return JsonResponse
     */
    public function addAdditionalBlock(): JsonResponse
    {
        return response()
            ->json([
                'body' => view('admin.products.partials.additional')->render()
            ]);
    }

    /**
     * @param int $block
     * @return JsonResponse
     */
    public function addInformationBlock(int $block = 0): JsonResponse
    {
        return response()
            ->json([
                'body' => view('admin.products.partials.information', compact('block'))->render()
            ]);
    }

}
