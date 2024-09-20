<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\OrderService as OrderServiceContract;
use App\Models\GuestProduct;

/**
 * Class OrderService
 * @package App\Services\Admin
 *
 */
class OrderService implements OrderServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllOrders($all = false)
    {
        if ($all) {
            return GuestProduct::with(['product', 'guest'])->cursor();
        }

        return GuestProduct::paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function changeStatus(string $status, GuestProduct $order): GuestProduct
    {
        $order->status = $status;
        $order->save();

        return $order;
    }


}
