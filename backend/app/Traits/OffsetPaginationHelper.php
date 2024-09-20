<?php
declare(strict_types=1);

namespace App\Traits;

use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
trait OffsetPaginationHelper
{
    /**
     * Helper pagination
     * @param Builder|BelongsToMany $obBuilder
     * @param OffsetDto $offsetDto
     * @param string|array $columns
     * @return OffsetPaginationDTO
     */
    public function offsetPaginate($obBuilder, OffsetDto $offsetDto, $columns = ['*']): OffsetPaginationDTO
    {
        $iTotal = $obBuilder->count($columns);
        $obItems = $obBuilder
            ->offset($offsetDto->offset)
            ->limit($offsetDto->limit)
            ->get($columns);

        return new OffsetPaginationDTO([
            'total' => $iTotal,
            'items' => $obItems,
        ]);
    }
}
