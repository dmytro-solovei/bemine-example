<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\TagService as TagServiceContract;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class TagService
 * @package App\Services\Admin
 *
 */
class TagService implements TagServiceContract
{
    private const PAGINATE_COUNT = 10;

    /**
     * @inheritDoc
     */
    public function getAllTags(): ?LengthAwarePaginator
    {
        return Tag::paginate(self::PAGINATE_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function saveTag(string $name): Tag
    {
        return Tag::create(['name' => $name]);
    }

    /**
     * @inheritDoc
     */
    public function updateTag(string $name, Tag $tag): Tag
    {
        $tag->name = $name;
        $tag->save();

        return $tag;
    }


}
