<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\ColorService;
use App\Classes\Dto\Admin\ColorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorStoreRequest;
use App\Http\Requests\Admin\ColorUpdateRequest;
use App\Models\Color;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ColorController
 * @package App\Controllers\Admin
 *
 */
class ColorController extends Controller
{
    /**
     * @var ColorService
     */
    private ColorService $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $colors = $this->colorService->getAllColors();

        return view('admin.colors.index', compact('colors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * @param ColorStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ColorStoreRequest $request): RedirectResponse
    {
        $this->colorService->saveColor(
            new ColorDto([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
            ])
        );

        return redirect()->route('color.index');

    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * @param ColorUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ColorUpdateRequest $request, $id): RedirectResponse
    {
        $color = Color::findOrFail($id);
        $this->colorService->updateColor(
            new ColorDto([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
            ]),
            $color
        );

        return redirect()->route('color.index');
    }

}
