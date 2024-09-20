<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ColorService
 * @package App\Classes\Contracts\Services
 *
 */
interface ColorService
{

    /**
     * @return Collection|null
     */
    public function getAllColors(): ?Collection;

}
