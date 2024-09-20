<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\SettingService;
use App\Classes\Dto\Admin\SettingDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingStoreRequest;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class SettingController
 * @package App\Controllers\Admin
 *
 */
class SettingController extends Controller
{
    /**
     * @var SettingService
     */
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $settings = $this->settingService->getAllSettings();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * @param SettingUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(SettingUpdateRequest $request, $id): RedirectResponse
    {
        $setting = Setting::findOrFail($id);
        $this->settingService->updateSetting(
            new SettingDto([
                'main_color' => $request->main_color,
                'currency_value' => $request->currency_value,
            ]),
            $setting
        );

        return redirect()->route('setting.index');
    }

}
