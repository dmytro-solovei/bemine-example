<?php

namespace App\Services;

use App\Classes\Contracts\Services\ProductService as ProductServiceContract;
use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Product;
use App\Models\Section;
use App\Traits\OffsetPaginationHelper;
use App\Utils\QueryUtil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductService
 * @package App\Services
 *
 */
class ProductService implements ProductServiceContract
{
    use OffsetPaginationHelper;

    protected array $orderBy = [
        'asc' => 'ASC',
        'desc' => 'DESC',
    ];

    private const PAGINATION_COUNT = 6;

    /**
     * @inheritDoc
     */
    public function
    getAllProducts(OffsetDto $offsetDto, FilterDto $filterDto)
    {

        return Product::with(['productDetails'])
            ->when($filterDto->search, static function (Builder $query, string $sSearch): void {
                /** @var Product $query */
                $query->findByName($sSearch);
            })
            ->when(isset($filterDto->filter['brands']), function (Builder $query) use ($filterDto) {
                $query->whereIn('brand_id', $filterDto->filter['brands']);
            })
            ->when(isset($filterDto->filter['min_price']), function (Builder $query) use ($filterDto) {
                $query->where('price', '>=', $filterDto->filter['min_price']);
            })
            ->when(isset($filterDto->filter['max_price']), function (Builder $query) use ($filterDto) {
                $query->where('price', '<=', $filterDto->filter['max_price']);
            })
            ->when(isset($filterDto->filter['categories']), function (Builder $query) use ($filterDto) {

                $sectionIds = Section::getchildSectionIdQuery($filterDto->filter['categories']);
                $subquery = QueryUtil::getQuery($sectionIds);

                $query->join('product_section', 'product_section.product_id', 'products.id')
                    ->join(DB::raw("($subquery) as cte"), function ($join) {
                        $join->on('product_section.section_id', '=', 'cte.id');
                    })->select(['products.*'])
                    ->distinct('products.id');
            })
            ->when(isset($filterDto->filter['sizes']), function (Builder $query) use ($filterDto) {
                $query->whereHas('productProperties', function (Builder $query) use ($filterDto) {
                    $query->whereIn('size_id', $filterDto->filter['sizes']);
                });
            })
            ->when(isset($filterDto->filter['colors']), function (Builder $query) use ($filterDto) {
                $query->whereHas('productProperties', function (Builder $query) use ($filterDto) {
                    $query->whereIn('color_id', $filterDto->filter['colors']);
                });
            })
            ->when(isset($filterDto->filter['tags']), function (Builder $query) use ($filterDto) {
                $query->whereHas('tags', function (Builder $query) use ($filterDto) {
                    $query->whereIn('tag_id', $filterDto->filter['tags']);
                });
            })
            ->when(isset($filterDto->filter['by_price']), function (Builder $query) use ($filterDto) {
                $query->orderBy('price', $this->orderBy[strtolower($filterDto->filter['by_price'])]);
            })
            ->with('gallery.properties')
            ->active()
            ->orderBy('sort', $this->orderBy['asc'])
            ->paginate($filterDto->filter['per_page'] ?? self::PAGINATION_COUNT, $columns = ['*'], $pageName = 'page', $filterDto->filter['page'] ?? 1);
    }

    /**
     * @inheritDoc
     */
    public function getProduct(int $productId): Product
    {
        return Product::active()->with(['gallery.properties' => function (HasMany $query) {
            $query->with(['color', 'size']);
        }])
            ->with('productDetails', 'brand')
            ->findOrFail($productId);
    }

    /**
     * @param $slug
     * @return Product
     */
    public function getProductBySlug($slug): Product
    {
        return Product::active()->with(['gallery.properties' => function (HasMany $query) {
            $query->with(['color', 'size']);
        }])
            ->with('productDetails', 'brand')
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getProductByIds(array $productIds): ?Collection
    {
        return Product::whereIn('id', $productIds)->get();
    }

}
