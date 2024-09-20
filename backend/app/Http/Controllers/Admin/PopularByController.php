<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\PopularByService;
use App\Classes\Dto\Admin\BrandDto;
use App\Classes\Enum\PopularByEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandStoreRequest;
use App\Models\Brand;
use App\Classes\Contracts\Services\Admin\BrandService;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class PopularByController
 * @package App\Controllers\Admin
 *
 */
class PopularByController extends Controller
{

    /**
     * @var PopularByService
     */
    private PopularByService $popularByService;

    public function __construct(PopularByService $popularByService)
    {
        $this->popularByService = $popularByService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $popularTypes = $this->popularByService->getAllPopularTypes();

        return view('admin.popular_types.index', compact('popularTypes'));
    }

    public function create()
    {
        $popularTypes = array_keys(PopularByEnum::toArray());
        return view('admin.popular_types.create', compact('popularTypes'));
    }


}
