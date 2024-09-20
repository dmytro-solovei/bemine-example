<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\GalleryService as GalleryServiceContract;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

/**
 * Class GalleryService
 * @package App\Services\Admin
 *
 */
class GalleryService implements GalleryServiceContract
{

    /**
     * @inheritDoc
     */
    public function deleteProductGalleryBlock(Product $product, string $ids): array
    {
        return DB::transaction(function () use ($ids) {

            try {
                $ids = array_map('intval', explode(',', $ids));
                $images = ProductGallery::whereIn('id', $ids);
                $images->pluck('image')->each(function ($imagePath) {
                    $this->deleteImages($imagePath);
                });
                $images->delete();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }

            return $ids;

        }, 5);
    }

    /**
     * @param string $imagePath
     * @return void
     */
    public function deleteImages(string $imagePath): void
    {
        $file = new Filesystem;
        $file->delete(storage_path('app/public/' . $imagePath));
    }

}
