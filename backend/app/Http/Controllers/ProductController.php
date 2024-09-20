<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\ProductService;
use App\Http\Requests\Admin\ProductByIdsRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OffsetRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ProductController
 * @package App\Controllers
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
     * @param OffsetRequest $obOffsetRequest
     * @param FilterRequest $obFilterRequest
     * @return AnonymousResourceCollection
     */
    public function index(OffsetRequest $obOffsetRequest, FilterRequest $obFilterRequest): AnonymousResourceCollection
    {
        $obOffsetDto = $obOffsetRequest->getDto();

        $products = $this->productService->getAllProducts(
            $obOffsetDto,
            $obFilterRequest->getDto()
        );

        return ProductResource::collection($products);
    }

    /**
     * @param int $productId
     * @return ProductResource
     */
    public function show(int $productId): ProductResource
    {
        $product = $this->productService->getProduct($productId);

        return new ProductResource($product);
    }

    /**
     * @param string $slug
     * @return ProductResource
     */
    public function getProductBySlug(string $slug): ProductResource
    {
        $product = $this->productService->getProductBySlug($slug);

        return new ProductResource($product);
    }

    /**
     * @param ProductByIdsRequest $request
     * @return AnonymousResourceCollection
     */
    public function byIds(ProductByIdsRequest $request): AnonymousResourceCollection
    {
        $products = $this->productService->getProductByIds($request->product_ids);

        return ProductResource::collection($products);
    }

}
