<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\SlideService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideGroupStoreRequest;
use App\Http\Requests\Admin\SlideGroupUpdateRequest;
use App\Models\Slide;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class BrandController
 * @package App\Controllers\Admin
 *
 */
class SlidesController extends Controller
{
    /**
     * @var SlideService
     */
    private SlideService $slideService;

    public function __construct(SlideService $slideService)
    {
        $this->slideService = $slideService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $slides = $this->slideService->getAllSlides();

        return view('admin.slides.index', compact('slides'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * @param SlideGroupStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SlideGroupStoreRequest $request): RedirectResponse
    {
        $slideGroup = $this->slideService->saveSlideGroup($request->name, $request->active === 'on');

        return redirect()->route('slide.index');
    }


    /**
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $slide = Slide::findOrFail($id);

        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * @param SlideGroupUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SlideGroupUpdateRequest $request, int $id): RedirectResponse
    {
        $slideGroup = Slide::findOrFail($id);

        $this->slideService->updateSlideGroup($slideGroup, $request->name, $request->active === 'on');

        return redirect()->route('slide.index');

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        return redirect()->route('slide.index');
    }

}
