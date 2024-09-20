<?php

namespace App\Services;

use App\Classes\Contracts\Services\SettingService as SettingServiceContract;
use App\Models\Color;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SettingService
 * @package App\Services
 *
 */
class SettingService implements SettingServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllSettings(): ?Collection
    {
        return Setting::all();
    }


}
