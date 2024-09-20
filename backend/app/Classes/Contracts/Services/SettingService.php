<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SettingService
 * @package App\Classes\Contracts\Services
 *
 */
interface SettingService
{

    /**
     * @return Collection|null
     */
    public function getAllSettings(): ?Collection;

}
