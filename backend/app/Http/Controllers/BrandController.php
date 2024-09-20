<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\BrandService;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OffsetRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class BrandController
 * @package App\Controllers
 *
 */
class BrandController extends Controller
{

    /**
     * @var BrandService
     */
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param OffsetRequest $obOffsetRequest
     * @param FilterRequest $obFilterRequest
     * @return AnonymousResourceCollection
     */
    public function index(OffsetRequest $obOffsetRequest, FilterRequest $obFilterRequest): AnonymousResourceCollection
    {
        $obOffsetDto = $obOffsetRequest->getDto();

        $brands = $this->brandService->getAllBrands(
            $obOffsetDto,
            $obFilterRequest->getDto()
        );

        return BrandResource::collection($brands->items)->additional(
            [
                'meta' => [
                    'paginate' => $brands->meta($obOffsetDto->offset, $obOffsetDto->limit),
                ],
                'status' => 'success',
            ]
        );
    }

    /**
     * @param int $brandId
     * @return BrandResource
     */
    public function show(int $brandId): BrandResource
    {
        $brand = $this->brandService->getBrand($brandId);

        return new BrandResource($brand);
    }


}
