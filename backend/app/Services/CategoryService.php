<?php

namespace App\Services;

use App\Classes\Contracts\Services\CategoryService as CategoryServiceContract;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Section;
use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;


/**
 * Class ChannelPostService
 * @package UserFeed\Services
 *
 */
class CategoryService implements CategoryServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    /**
     * @inheritDoc
     */
    public function getAllCategoriesBySection(int $sectionId): Collection
    {
        return Category::where('section_id', $sectionId)->get();
    }

    /**
     * @inheritDoc
     */
    public function getCategoriesByParent($categoryId): Collection
    {

        return Category::where('parent_id', $categoryId)->get();
    }

    /**
     * @inheritDoc
     */
    public function getOnlyParentCategories(): Collection
    {
        return Category::whereNull('parent_id')->get();
    }

    /**
     * @param $categoryIds
     * @return Collection
     */
    public function getCategoryBrands($categoryIds): Collection
    {
        return Brand::when($categoryIds , function ($query) use ($categoryIds) {
           return $query->whereHas('categories', function ($query) use ($categoryIds){
                $query->whereIn('sections.id', $categoryIds);
            });
        })
            ->get();
    }

    /**
     * @param $categoryIds
     * @return Collection
     */
    public function getCategorySizes($categoryIds): Collection
    {
        return Size::when($categoryIds , function ($query) use ($categoryIds) {
            return $query->whereHas('categories', function ($query) use ($categoryIds){
                $query->whereIn('sections.id', $categoryIds);
            });
        })
            ->get();
    }

    /**
     * @param $categoryId
     */
    public function getSubCategories($categoryId)
    {
        $section = Section::where('id', $categoryId)->first();

        if (count($section->subSections)) {
            return $section->subSections;
        }

        return $section->parentCategory->subSections ?? [];
    }

}


