<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\LanguageService;
use App\Classes\Contracts\Services\Admin\SectionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionStoreRequest;
use App\Http\Requests\Admin\SectionUpdateRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class SectionController
 * @package App\Controllers\Admin
 *
 */
class SectionController extends Controller
{

    /**
     * @var SectionService
     */
    private SectionService $sectionsService;
    private LanguageService $languageService;

    public function __construct(SectionService $sectionsService, LanguageService $languageService)
    {
        $this->sectionsService = $sectionsService;
        $this->languageService = $languageService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $sections = $this->sectionsService->getAllSections();

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * @return View
     */
    public function create()
    {
        $sections = $this->sectionsService->getAllSections();

        return view('admin.sections.create', compact('sections'));
    }

    /**
     * @param SectionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SectionStoreRequest $request): RedirectResponse
    {
        $this->sectionsService->saveSection($request->validated());

        return redirect()->route('section.create');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $section = Section::findOrFail($id);

        return view('admin.sections.edit', compact('section'));
    }

    /**
     * @param SectionUpdateRequest $request
     * @param int $sectionId
     * @return SectionResource
     */
    public function update(SectionUpdateRequest $request, int $sectionId): SectionResource
    {
        $section = Section::findOrFail($sectionId);

        $section = $this->sectionsService->updateSection($request->validated(), $section);

        return SectionResource::make($section);
    }

    /**
     * \
     * @param Section $section
     * @return RedirectResponse
     */
    public function destroy(Section $section)
    {
        $canBeDeleted = $this->sectionsService->checkCanBeDeleted($section);

        if ($canBeDeleted) {
            $this->sectionsService->delete($section);
        } else {
            return redirect()->route('section.create')->withErrors(['message' => "We have products in this category or it's subCategory please empty category items before delete"]);
        }

        return redirect()->route('section.create')->with('success', 'Section deleted successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function addSectionEditBlock($id): JsonResponse
    {
        $section = $this->sectionsService->getSection((int)$id);

        return response()
            ->json([
                'body' => view('admin.sections.includes.edit_input', compact('section'))->render()
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function addSectionCreateBlock(): JsonResponse
    {
        $languages = $this->languageService->getAllLanguages();

        return response()
            ->json([
                'body' => view('admin.sections.includes.create_input', compact('languages'))->render()
            ]);
    }
}
