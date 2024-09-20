<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\UserService;
use App\Classes\Contracts\Services\WishListService;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OffsetRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class WishListController
 * @package App\Controllers
 *
 */
class WishListController extends Controller
{
    /**
     * @var WishListService
     */
    private WishListService $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->wishListService = $wishListService;
    }

    /**
     * @param OffsetRequest $obOffsetRequest
     * @param FilterRequest $obFilterRequest
     * @return AnonymousResourceCollection
     */
    public function index(OffsetRequest $obOffsetRequest, FilterRequest $obFilterRequest): AnonymousResourceCollection
    {
        $obOffsetDto = $obOffsetRequest->getDto();

        $products = $this->wishListService->getAllList(
            $obOffsetDto,
            $obFilterRequest->getDto()
        );

        return ProductResource::collection($products->items)->additional(
            [
                'meta' => [
                    'paginate' => $products->meta($obOffsetDto->offset, $obOffsetDto->limit),
                ],
                'status' => 'success',
            ]
        );
    }

}
