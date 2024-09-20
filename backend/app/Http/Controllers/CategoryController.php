<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Classes\Contracts\Services\CategoryService;
use App\Http\Resources\BrandResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SizeResource;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryBrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CategoryController
 * @package App\Controllers
 *
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getAllCategories();

        return CategoryResource::collection($categories);
    }

    /**
     * @param int $sectionId
     * @return AnonymousResourceCollection
     */
    public function getBySection(int $sectionId): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getAllCategoriesBySection($sectionId);

        return CategoryResource::collection($categories);
    }

    /**
     * @param int $categoryId
     * @return AnonymousResourceCollection
     */
    public function getByParent(int $categoryId): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getCategoriesByParent($categoryId);

        return CategoryResource::collection($categories);
    }

    /**
     * @param int $categoryId
     * @return CategoryResource
     */
    public function show(int $categoryId): CategoryResource
    {
        $category = Category::findOrfail($categoryId);

        return new CategoryResource($category);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getOnlyParents(): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getOnlyParentCategories();

        return CategoryResource::collection($categories);
    }


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getCategoryBrands(Request $request): AnonymousResourceCollection
    {
        $categoryIds = '';
        if (isset($request->ids)) {
            $categoryIds = explode(',', $request->ids);
        }

        $brands = $this->categoryService->getCategoryBrands($categoryIds);

        return BrandResource::collection($brands);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getCategorySizes(Request $request): AnonymousResourceCollection
    {
        $categoryIds = '';
        if (isset($request->ids)) {
            $categoryIds = explode(',', $request->ids);
        }

        $sizes = $this->categoryService->getCategorySizes($categoryIds);

        return SizeResource::collection($sizes);
    }

    /**
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function getSubCategories($id): AnonymousResourceCollection
    {
        $subCategories = $this->categoryService->getSubCategories($id);

        return SectionResource::collection($subCategories);
    }

}
