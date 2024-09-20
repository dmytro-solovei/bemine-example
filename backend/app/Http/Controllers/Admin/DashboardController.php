<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\DashboardService;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Controllers\Admin
 *
 */
class DashboardController extends Controller
{

    /**
     * @var DashboardService
     */
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $counts = $this->dashboardService->getAllInfo();

        return view('admin.dashboard', compact('counts'));
    }


}
