<?php
declare(strict_types=1);

namespace App\Classes\Dto;

use Illuminate\Support\Collection;

/**
 * Class OffsetPaginationDTO
 * @package App\Classes\Dto
 *
 */
class OffsetPaginationDTO extends DataTransferObject
{
    /**
     * @var int
     */
    public int $total;

    /**
     * @var Collection
     */
    public Collection $items;

    /**
     * @param $iOffset
     * @param $iLimit
     * @return array
     */
    public function meta($iOffset, $iLimit): array
    {
        return [
            'total' => $this->total,
            'offset' => $iOffset,
            'limit' => $iLimit,
        ];
    }

}
