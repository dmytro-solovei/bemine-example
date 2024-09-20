<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\ProductDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface ProductService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface ProductService
{
    /**
     * @param bool $all
     * @param array|null $filter
     * @return mixed
     */
    public function getAllProducts(bool $all = false, array $filter = null);

    /**
     * @param ProductDto $productDto
     * @return Product|null
     */
    public function saveProduct(ProductDto $productDto): ?Product;

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return Product|null
     * @throws \Exception
     */
    public function updateProduct(ProductDto $productDto, Product $product): ?Product;

    /**
     * @param Product $product
     * @return bool
     */
    public function deleteProduct(Product $product): bool;


    /**
     * @param Product $product
     * @return bool
     */
    public function toggleActive(Product $product): bool;

    /**
     * @param Product $product
     * @return array
     */
    public function getEditData(Product $product): array;

    /**
     * @return int
     */
    public function getProductSortIsBigCount(): int;

}
