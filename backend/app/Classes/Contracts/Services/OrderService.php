<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\OrderDto;

/**
 * Interface OrderService
 * @package App\Classes\Contracts\Services
 *
 */
interface OrderService
{

    /**
     * @param OrderDto $orderDto
     * @return bool
     */
    public function storeOrders(OrderDto $orderDto): bool;

}
