<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\ColorService;
use App\Http\Resources\ColorResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ColorController
 * @package App\Controllers
 *
 */
class ColorController extends Controller
{

    /**
     * @var ColorService
     */
    private ColorService $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $colors = $this->colorService->getAllColors();

        return ColorResource::collection($colors);
    }


}
