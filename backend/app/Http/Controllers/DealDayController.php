<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\DealDayService;
use App\Http\Resources\DealDayResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class DealDayController
 * @package App\Controllers
 *
 */
class DealDayController extends Controller
{

    /**
     * @var DealDayService
     */
    private DealDayService $dealDayService;

    public function __construct(DealDayService $dealDayService)
    {
        $this->dealDayService = $dealDayService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $deals = $this->dealDayService->getAllDeals();

        return DealDayResource::collection($deals)->additional(
            [
                'status' => 'success',
            ]
        );
    }

}
