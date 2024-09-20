<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\BrandService;
use App\Classes\Contracts\Services\ProductReviewService;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OffsetRequest;
use App\Http\Resources\ProductReviewResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class BrandController
 * @package App\Controllers
 *
 */
class ProductReviewController extends Controller
{

    /**
     * @var ProductReviewService $productReviewService
     */
    private ProductReviewService $productReviewService;

    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }

    //todo: product_id required
    /**
     * @param OffsetRequest $obOffsetRequest
     * @param FilterRequest $obFilterRequest
     * @return AnonymousResourceCollection
     */
    public function index(OffsetRequest $obOffsetRequest, FilterRequest $obFilterRequest): AnonymousResourceCollection
    {
        $obOffsetDto = $obOffsetRequest->getDto();

        $reviews = $this->productReviewService->getProductAllReviews(
            $obOffsetDto,
            $obFilterRequest->getDto()
        );

        return ProductReviewResource::collection($reviews->items)->additional(
            [
                'meta' => [
                    'paginate' => $reviews->meta($obOffsetDto->offset, $obOffsetDto->limit),
                ],
                'status' => 'success',
            ]
        );
    }

}
