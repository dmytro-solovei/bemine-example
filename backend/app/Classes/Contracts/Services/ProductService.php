<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\OffsetPaginationDTO;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ProductService
 * @package App\Classes\Contracts\Services
 *
 */
interface ProductService
{

    /**
     * @param OffsetDto $offsetDto
     * @param FilterDto $filterDto
     */
    public function getAllProducts(OffsetDto $offsetDto, FilterDto $filterDto);

    /**
     * @param int $productId
     * @return Product|null
     */
    public function getProduct(int $productId): ?Product;

    /**
     * @param string $slug
     * @return Product|null
     */
    public function getProductBySlug(string $slug): Product;

    /**
     * @param array $productIds
     * @return Collection|null
     */
    public function getProductByIds(array $productIds): ?Collection;

}
