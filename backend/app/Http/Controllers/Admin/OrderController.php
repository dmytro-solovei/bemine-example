<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\OrderService;
use App\Classes\Enum\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\GuestProduct;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class OrderController
 * @package App\Controllers\Admin
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrders();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $order = GuestProduct::with(['guest.orders', 'size', 'color'])->findOrFail($id);
        $statuses = OrderStatusEnum::toArray();

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    /**
     * @return RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function changeOrderStatus(): RedirectResponse
    {
        $order = GuestProduct::findOrFail(request()->get('order'));
        $this->orderService->changeStatus(request()->get('status'), $order);

        return redirect()->back();
    }

}
