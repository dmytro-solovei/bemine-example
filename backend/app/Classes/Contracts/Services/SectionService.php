<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SectionService
 * @package App\Classes\Contracts\Services
 *
 */
interface SectionService
{

    /**
     * @return Collection
     */
    public function getAllParentSections(): Collection;
}
