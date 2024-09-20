<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface BrandService
 * @package App\Classes\Contracts\Services
 *
 */
interface BrandService
{
    /**
     * @param OffsetDto $obOffsetDto
     * @param FilterDto $obFilterDto
     * @return OffsetPaginationDTO|null
     */
    public function getAllBrands(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?OffsetPaginationDTO;

    /**
     * @param $brandId
     * @return Brand
     */
    public function getBrand($brandId): Brand;

}
