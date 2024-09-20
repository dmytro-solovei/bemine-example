<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\TagService;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class TagController
 * @package App\Controllers
 *
 */
class TagController extends Controller
{

    /**
     * @var TagService
     */
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $tags = $this->tagService->getAllTags();

        return TagResource::collection($tags)->additional(
            [
                'status' => 'success',
            ]
        );
    }

}
