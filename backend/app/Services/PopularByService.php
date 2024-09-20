<?php

namespace App\Services;

use App\Classes\Contracts\Services\PopularByService as PopularByServiceContract;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\PopularBy;
use App\Models\Product;
use App\Traits\OffsetPaginationHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BrandService
 * @package UserFeed\Services
 *
 */
class PopularByService implements PopularByServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getAllPopularsByType(): ?Collection
    {
        return PopularBy::with('product.brand')->get();
    }

    /**
     * @inheritDoc
     */
    public function getProductsByGroup(string $group): ?Collection
    {
        return Product::wherehas('slideGroups', function (Builder $query) use ($group) {
            $query->where('name', $group);
        })->get();
    }

}
