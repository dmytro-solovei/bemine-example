<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\SettingService as SettingServiceContract;
use App\Classes\Dto\Admin\SettingDto;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BrandService
 * @package App\Services\Admin
 *
 */
class SettingService implements SettingServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllSettings(): ?LengthAwarePaginator
    {
        return Setting::paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function updateSetting(SettingDto $settingDto, Setting $setting): Setting
    {
        $setting->main_color = $settingDto->main_color;
        $setting->currency_value = $settingDto->currency_value;
        $setting->save();

        return $setting;
    }

}
