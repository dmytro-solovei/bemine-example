<?php

namespace App\Services;

use App\Classes\Contracts\Services\DealDayService as DealDayServiceContract;
use App\Models\DealDay;
use App\Traits\OffsetPaginationHelper;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DealDayService
 * @package UserFeed\Services
 *
 */
class DealDayService implements DealDayServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getAllDeals(): ?Collection
    {
        return DealDay::all();
    }


}
