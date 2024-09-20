<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\LanguageService;
use App\Classes\Dto\Admin\LanguageDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    /**
     * @var LanguageService
     */
    protected $languageService;

    /**
     * @param LanguageService $languageService
     */
    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $languages = $this->languageService->index();

        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(LanguageRequest $request): RedirectResponse
    {
        $this->languageService->store(
            (array)new LanguageDto([
                'name' => $request->name,
            ]),
        );

        return redirect()->route('language.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Language $language
     * @return Application|Factory|View
     */
    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(LanguageRequest $request, Language $language): RedirectResponse
    {
        $this->languageService->update(
            (array)new LanguageDto([
                'name' => $request->name,
            ]),
            $language
        );

        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(Language $language): RedirectResponse
    {
        $language->delete();

        return redirect()->route('language.index');
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getAllLanguages(): AnonymousResourceCollection
    {
        $languages = $this->languageService->getAllLanguages();

        return LanguageResource::collection($languages);
    }
}
