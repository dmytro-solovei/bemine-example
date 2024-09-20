<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\PopularByService;
use App\Http\Resources\PopularByResource;
use App\Http\Resources\ProductsBySlideGroupResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class PopularByController
 * @package App\Controllers
 *
 */
class PopularByController extends Controller
{

    /**
     * @var PopularByService
     */
    private PopularByService $popularByService;

    public function __construct(PopularByService $popularByService)
    {
        $this->popularByService = $popularByService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $allPopularsByType = $this->popularByService->getAllPopularsByType();

        return PopularByResource::collection($allPopularsByType);
    }

    /**
     * @param string $group
     * @return AnonymousResourceCollection
     */
    public function bySlideGroup(string $group): AnonymousResourceCollection
    {
        $products = $this->popularByService->getProductsByGroup($group);

        return ProductsBySlideGroupResource::collection($products);
    }

}
