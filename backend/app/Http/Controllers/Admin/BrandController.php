<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Dto\Admin\BrandDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandStoreRequest;
use App\Classes\Contracts\Services\Admin\BrandService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class BrandController
 * @package App\Controllers\Admin
 *
 */
class BrandController extends Controller
{

    /**
     * @var BrandService
     */
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $brands = $this->brandService->getAllBrands();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->brandService->getCategories();

        return view('admin.brands.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param BrandStoreRequest $request
     * @return RedirectResponse
     */
    public function store(BrandStoreRequest $request): RedirectResponse
    {
        $this->brandService->saveBrand($request, $request->avatar);

        return redirect()->route('brand.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $brand = $this->brandService->getBrand($id);
        $categories = $this->brandService->getCategories();

        return view('admin.brands.edit', [
            'brand' => $brand,
                        'categories' => $categories,
        ]);
    }

    /**
     * @param BrandStoreRequest $request
     * @param int $brandId
     * @return RedirectResponse
     */
    public function update(BrandStoreRequest $request, int $brandId): RedirectResponse
    {
        $brand = $this->brandService->getBrand($brandId);

        $this->brandService->updateBrand(
            new BrandDto([
                'name' => $request->name,
                'file' => $request->avatar,
                'categories' => $request->categories,
                'brand' => $brand,
            ])
        );

        return redirect()->route('brand.index');
    }

    /**
     * @param int $brandId
     * @return RedirectResponse
     */
    public function inactive(int $brandId): RedirectResponse
    {
        $brand = $this->brandService->getBrand($brandId);

        $this->brandService->toggleActive($brand);

        return redirect()->route('brand.index');
    }

    /**
     * @param int $brandId
     * @return RedirectResponse
     */
    public function destroy(int $brandId): RedirectResponse
    {
        $brand = $this->brandService->getBrand($brandId);

        $this->brandService->deleteBrand($brand);

        return redirect()->route('brand.index');
    }


}
