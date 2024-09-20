<?php

namespace App\Services;

use App\Classes\Contracts\Services\TagService as TagServiceContract;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TagService
 * @package App\Services
 *
 */
class TagService implements TagServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllTags(): ?Collection
    {
        return Tag::all();

    }


}
