<?php

namespace App\Services;

use App\Classes\Contracts\Services\WishListService as WishListServiceContract;
use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Product;
use App\Traits\OffsetPaginationHelper;

/**
 * Class UserService
 * @package App\Services
 *
 */
class WishListService implements WishListServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getAllList(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?OffsetPaginationDTO
    {
        //todo: add product, then check with whereHas
        $builder = Product::active();

        return $this->offsetPaginate($builder, $obOffsetDto);
    }

}
