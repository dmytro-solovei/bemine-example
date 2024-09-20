<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\Product;

/**
 * Interface GalleryService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface GalleryService
{
    /**
     * @param Product $product
     * @param string $ids
     * @return array
     */
    public function deleteProductGalleryBlock(Product $product, string $ids): array;

}
