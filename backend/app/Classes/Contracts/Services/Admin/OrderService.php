<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\GuestProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface OrderService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface OrderService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllOrders($all = false);

    /**
     * @param string $status
     * @param GuestProduct $order
     * @return GuestProduct
     */
    public function changeStatus(string $status, GuestProduct $order): GuestProduct;

}
