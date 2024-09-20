<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface DealDayService
 * @package App\Classes\Contracts\Services
 *
 */
interface DealDayService
{
    /**
     * @return Collection|null
     */
    public function getAllDeals(): ?Collection;


}
