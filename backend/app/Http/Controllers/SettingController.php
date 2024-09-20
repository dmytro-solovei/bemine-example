<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\SettingService;
use App\Http\Resources\SettingResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SettingController
 * @package App\Controllers
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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $settings = $this->settingService->getAllSettings();

        return SettingResource::collection($settings);
    }



    /**
     * @return array
     */
    public function show()
    {

        return [
            'autoplay' => false,
            'autoplaySpeed' => 1000,
            'arrows' => true,
            'dots' => false,
            'infinite' => true,
            'speed' => 800,
            'slidesToShow' => 3,
            'slidesToScroll' => 1,
            'responsive' => [
                [
                    'breakpoint' => 480,
                    'settings' => [
                        'slidesToShow' => 1,
                    ],
                ],
                [
                    'breakpoint' => 767,
                    'settings' => [
                        'slidesToShow' => 2,
                    ],
                ],
                [
                    'breakpoint' => 2000,
                    'settings' => [
                        'slidesToShow' => 3,
                    ],
                ],
            ],
        ];

    }

}
