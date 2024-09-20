<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\OffsetPaginationDTO;

/**
 * Interface DashboardService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface DashboardService
{

    public function getAllInfo(): array;

}
