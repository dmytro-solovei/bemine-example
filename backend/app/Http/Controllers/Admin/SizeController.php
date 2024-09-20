<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\SizeService;
use App\Classes\Dto\Admin\SizeDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeStoreRequest;
use App\Http\Requests\Admin\SizeUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SizeController
 * @package App\Controllers\Admin
 *
 */
class SizeController extends Controller
{

    /**
     * @var SizeService
     */
    private SizeService $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $sizes = $this->sizeService->getAllSizes();

        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories =  $this->sizeService->getCategories();

        return view('admin.sizes.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param SizeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SizeStoreRequest $request): RedirectResponse
    {
        $this->sizeService->saveSize($request);

        return redirect()->route('size.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $size = $this->sizeService->getSize($id);
        $categories = $this->sizeService->getCategories();

        return view('admin.sizes.edit', [
            'size' => $size,
            'categories' => $categories,
        ]);
    }

    /**
     * @param SizeUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SizeUpdateRequest $request, int $id): RedirectResponse
    {
        $size = $this->sizeService->getSize($id);

        $this->sizeService->updateSize(
            new SizeDto([
                'name' => $request->name,
                'description' => $request->description,
                'categories' => $request->categories
            ]),
            $size
        );

        return redirect()->route('size.index');
    }


}
