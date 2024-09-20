<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\SettingDto;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface SettingService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface SettingService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllSettings();

    /**
     * @param SettingDto $settingDto
     * @param Setting $setting
     * @return Setting
     */
    public function updateSetting(SettingDto $settingDto, Setting $setting): Setting;

}
