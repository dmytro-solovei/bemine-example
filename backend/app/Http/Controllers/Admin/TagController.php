<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\TagService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagStoreRequest;
use App\Http\Requests\Admin\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class TagController
 * @package App\Controllers\Admin
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $tags = $this->tagService->getAllTags();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * @param TagStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TagStoreRequest $request): RedirectResponse
    {
        $this->tagService->saveTag($request->name);

        return redirect()->route('tag.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /***
     * @param TagUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TagUpdateRequest $request, int $id): RedirectResponse
    {
        $tag = Tag::findOrFail($id);

        $this->tagService->updateTag($request->name, $tag);

        return redirect()->route('tag.index');
    }


    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tag.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function inactive(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->active = !$tag->active;
        $tag->save();

        return redirect()->route('tag.index');
    }

}
