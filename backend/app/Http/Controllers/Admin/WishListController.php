<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\WishListService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class WishListController
 * @package App\Controllers\Admin
 *
 */
class WishListController extends Controller
{

    /**
     * @var WishListService
     */
    private WishListService $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->wishListService = $wishListService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $list = $this->wishListService->getAllWishLists();

        return view('admin.wishlists.index', compact('list'));
    }


}
