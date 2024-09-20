<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SizeService
 * @package App\Classes\Contracts\Services
 *
 */
interface SizeService
{
    /**
     * @return Collection|null
     */
    public function getSizes(): ?Collection;

    public function createSize();

}
