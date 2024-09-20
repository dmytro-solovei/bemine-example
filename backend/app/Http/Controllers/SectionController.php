<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\SectionService;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SectionController
 * @package App\Controllers
 *
 */
class SectionController extends Controller
{

    /**
     * @var SectionService
     */
    private SectionService $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $sections = $this->sectionService->getAllParentSections();

        return SectionResource::collection($sections);
    }

}
