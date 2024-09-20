<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface TagService
 * @package App\Classes\Contracts\Services
 *
 */
interface TagService
{
    /**
     * @return Collection|null
     */
    public function getAllTags(): ?Collection;


}
