<?php

namespace App\Services;

use App\Classes\Contracts\Services\ProductReviewService as ProductReviewServiceContract;
use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\ProductReview;
use App\Traits\OffsetPaginationHelper;

/**
 * Class ProductReviewService
 * @package App\Services
 *
 */
class ProductReviewService implements ProductReviewServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getProductAllReviews(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?OffsetPaginationDTO
    {
        $builder = ProductReview::when(isset($obFilterDto->filter['product_id']), function ($query) use ($obFilterDto) {
                $query->where('product_id', $obFilterDto->filter['product_id']);
            })
            ->active();

        return $this->offsetPaginate($builder, $obOffsetDto);
    }

}
