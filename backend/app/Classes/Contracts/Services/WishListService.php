<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;

/**
 * Interface WishListService
 * @package App\Classes\Contracts\Services
 *
 */
interface WishListService
{
    /**
     * @param OffsetDto $obOffsetDto
     * @param FilterDto $obFilterDto
     * @return OffsetPaginationDTO|null
     */
    public function getAllList(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?OffsetPaginationDTO;

}
