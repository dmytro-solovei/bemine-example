<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Models\Category;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryService
 * @package App\Classes\Contracts\Services
 *
 */
interface CategoryService
{

    /**
     * @return Collection
     */
    public function getAllCategories(): Collection;

    /**
     * @param int $sectionId
     * @return Collection
     */
    public function getAllCategoriesBySection(int $sectionId): Collection;

    /**
     * @param $categoryId
     * @return Collection
     */
    public function getCategoriesByParent($categoryId): Collection;

    /**
     * @return Collection
     */
    public function getOnlyParentCategories(): Collection;

    /**
     * @param $categoryIds
     * @return Collection
     */
    public function getCategoryBrands($categoryIds): Collection;

    /**
     * @param $categoryIds
     * @return Collection
     */
    public function getCategorySizes($categoryIds): Collection;

    /**
     * @param $categoryId
     */
    public function getSubCategories($categoryId);


}
