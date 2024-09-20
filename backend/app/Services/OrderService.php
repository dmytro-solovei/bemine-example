<?php

namespace App\Services;

use App\Classes\Contracts\Services\OrderService as OrderServiceContract;
use App\Classes\Dto\OrderDto;
use App\Models\Guest;
use App\Models\GuestProduct;

/**
 * Class OrderService
 * @package UserFeed\Services
 *
 */
class OrderService implements OrderServiceContract
{
    /**
     * @inheritDoc
     */
    public function storeOrders(OrderDto $orderDto): bool
    {
        $guest = Guest::firstOrCreate([
            'name' => $orderDto->name,
            'phone' => $orderDto->phone,
        ]);

        $orders = array_map(function ($order) use ($guest, $orderDto) {
            $now = now();
            return [
                'guest_id' => $guest->getKey(),
                'product_id' => $order['id'],
                'color_id' => $order['color'],
                'size_id' => $order['size'],
                'count' => $order['count'],
                'address' => $orderDto->address,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $orderDto->orders);

        GuestProduct::insert($orders);

        return true;
    }

}
