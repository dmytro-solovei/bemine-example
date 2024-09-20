<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\SizeService;
use App\Http\Resources\SizeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SizeController
 * @package App\Controllers
 *
 */
class SizeController extends Controller
{
    /**
     * @var SizeService
     */
    private SizeService $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }


    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $sizes = $this->sizeService->getSizes();

        return SizeResource::collection($sizes);

    }

}
