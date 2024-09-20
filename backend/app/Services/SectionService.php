<?php

namespace App\Services;

use App\Classes\Contracts\Services\SectionService as SectionServiceContract;
use App\Models\Section;
use App\Traits\OffsetPaginationHelper;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SectionService
 * @package App\Services
 *
 */
class SectionService implements SectionServiceContract
{
    use OffsetPaginationHelper;

    /**
     * @inheritDoc
     */
    public function getAllParentSections(): Collection
    {
        return Section::whereNull('parent_id')->with('subSections')->get();
    }

}
