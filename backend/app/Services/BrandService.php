<?php

namespace App\Services;

use App\Classes\Contracts\Services\BrandService as BrandServiceContract;
use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Brand;
use App\Traits\OffsetPaginationHelper;

/**
 * Class BrandService
 * @package UserFeed\Services
 *
 */
class BrandService implements BrandServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getAllBrands(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?OffsetPaginationDTO
    {
        $builder = Brand::query();

        return $this->offsetPaginate($builder, $obOffsetDto);
    }

    /**
     * @inheritDoc
     */
    public function getBrand($brandId): Brand
    {
        return Brand::findOrFail($brandId);
    }


}
