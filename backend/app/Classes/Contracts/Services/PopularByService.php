<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\OffsetPaginationDTO;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PopularByService
 * @package App\Classes\Contracts\Services
 *
 */
interface PopularByService
{
    /**
     * @return Collection|null
     */
    public function getAllPopularsByType(): ?Collection;

    /**
     * @param string $group
     * @return Collection|null
     */
    public function getProductsByGroup(string $group):? Collection;

}
