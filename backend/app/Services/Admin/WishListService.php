<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\WishListService as WishListServiceContract;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class WishListService
 * @package App\Services\Admin
 *
 */
class WishListService implements WishListServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllWishLists($all = false): ?LengthAwarePaginator
    {
        return WishList::paginate(10);
    }


}
