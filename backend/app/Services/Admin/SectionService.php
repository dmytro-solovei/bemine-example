<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\SectionService as SectionServiceContract;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

/**
 * Class SectionService
 * @package UserFeed\Services\Admin
 *
 */
class SectionService implements SectionServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllSections(bool $all = false)
    {
        if ($all) {
            return $this->getParentSections();
        }

        return Section::all();
    }

    /**
     * @return mixed
     */
    public function getParentSections()
    {
        return Section::whereNull('parent_id')->with('subSections')->get();
    }

    /**
     * @inheritDoc
     */
    public function saveSection(array $data): Section
    {
        return Section::create([
            'name' => collect($data)->except('parent_id'),
            'parent_id' => $data['parent_id'] ?? null
        ]);
    }

    /**
     * @inheritDoc
     */
    public function updateSection(array $data, Section $section): Section
    {
        $section->name = $data;
        $section->save();

        return $section;
    }



    /**
     * @param Section $section
     * @return bool
     */
    public function delete(Section $section): bool
    {
        return $section->delete();
    }

    /**
     * @param Section $section
     * @return bool
     */
    public function checkCanBeDeleted(Section $section): bool
    {
        $product_section = DB::table('product_section')->where('section_id', $section->id)->first();
        if ($product_section) {
            return false;
        }

        foreach ($section->subSections as $item) {
            $product_section = DB::table('product_section')->where('section_id', $item->id)->first();
            if ($product_section) {
                return false;
            }
            if ($item->subSections->isNotEmpty()) {
                return  $this->checkCanBeDeleted($item);
            }
        }

        return true;
    }

    /**
     * @param int $id
     * @return Section
     */
    public function getSection(int $id): Section
    {
        return Section::findOrFail($id);
    }
}
