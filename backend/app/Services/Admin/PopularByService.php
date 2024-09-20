<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\PopularByService as PopularByServiceContract;
use App\Models\PopularBy;
use Illuminate\Support\LazyCollection;

/**
 * Class PopularByService
 * @package App\Services\Admin
 *
 */
class PopularByService implements PopularByServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllPopularTypes($all = false)
    {
        return PopularBy::with('product')->paginate(10);
    }


}
