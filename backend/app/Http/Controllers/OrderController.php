<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\OrderService;
use App\Classes\Dto\OrderDto;
use App\Classes\Helper\PhoneNumberHelper;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

/**
 * Class OrderController
 * @package App\Controllers
 *
 */
class OrderController extends Controller
{

    /**
     * @var OrderService
     */
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param OrderStoreRequest $request
     * @return JsonResponse
     */
    public function store(OrderStoreRequest $request): JsonResponse
    {

        $this->orderService->storeOrders(
            new OrderDto([
                'name' => $request->name,
                'phone' => PhoneNumberHelper::normalizeArmenianNumber($request->phone),
                'address' => $request->address,
                'orders' => $request->orders,
            ])
        );

        return response()->json(['message' => 'ok'], Response::HTTP_OK);

    }

}
