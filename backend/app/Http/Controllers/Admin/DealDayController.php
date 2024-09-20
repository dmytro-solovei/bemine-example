<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\DealDayService;
use App\Classes\Contracts\Services\Admin\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DealDayStoreRequest;
use App\Models\DealDay;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

/**
 * Class DealDayController
 * @package App\Controllers\Admin
 *
 */
class DealDayController extends Controller
{

    /**
     * @var DealDayService
     */
    private DealDayService $dealDayService;

    public function __construct(DealDayService $dealDayService)
    {
        $this->dealDayService = $dealDayService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $dealDays = $this->dealDayService->getAllDealDays();

        return view('admin.deal_days.index', compact('dealDays'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $productService = app(ProductService::class);
        $products = $productService->getAllProducts(true);

        return view('admin.deal_days.create', compact('products'));
    }

    /**
     * @param DealDayStoreRequest $request
     * @return RedirectResponse
     */
    public function store(DealDayStoreRequest $request): RedirectResponse
    {
        $this->dealDayService->saveDealDay($request->deals);

        return redirect()->route('deal-day.index');
    }

    /**
     * @param int $dealDayCount
     * @return JsonResponse
     */
    public function addBlock(int $dealDayCount): JsonResponse
    {
        $productService = app(ProductService::class);
        $products = $productService->getAllProducts(true);

        return response()
            ->json([
                'body' => view('admin.deal_days.partials.add_deal_day',
                    compact('products', 'dealDayCount'))->render()
            ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $dealDay = DealDay::findOrFail($id);
        $this->dealDayService->deleteDealDay($dealDay);

        return redirect()->route('deal-day.index');
    }

}
