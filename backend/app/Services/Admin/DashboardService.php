<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\DashboardService as DashboardServiceContract;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Product;
use App\Models\User;

/**
 * Class DashboardService
 * @package UserFeed\Services\Admin
 *
 */
class DashboardService implements DashboardServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllInfo(): array
    {
        return [
            'users' => User::count(),
            'products' => Product::count()
        ];
    }


}
