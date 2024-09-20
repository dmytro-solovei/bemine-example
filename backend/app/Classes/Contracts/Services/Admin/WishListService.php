<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface WishListService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface WishListService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllWishLists($all = false);


}
