<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\ProductService as ProductServiceContract;
use App\Classes\Dto\Admin\ProductDto;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductProperty;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class BrandService
 * @package App\Services\Admin
 *
 */
class ProductService implements ProductServiceContract
{
    /**
     * @param $all
     * @param array|null $filter
     * @return LengthAwarePaginator|mixed
     */
    public function getAllProducts($all = false, array $filter = null)
    {
        if ($all) {
            return Product::select('id', 'title', 'img', 'old_price', 'price')->cursor();
        }

        return Product::with(['brand', 'sizes', 'popularsBy', 'productDetails'])
            ->when(!empty($filter), function (Builder $query) use ($filter) {
                $query->when(isset($filter['filter_popular_by']), function (Builder $query) use ($filter) {
                    $query->whereHas('popularsBy', function (Builder $query) use ($filter) {
                        $query->where($filter['filter_popular_by'], true);
                    });
                })
                ->when(isset($filter['search']), function ($query) use ($filter) {
                    $query->where('slug',  'LIKE', '%' . $filter['search'] . '%');
                });
            })

            ->orderBY('sort', 'asc')
            ->paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function saveProduct(ProductDto $productDto): ?Product
    {
        DB::beginTransaction();

        $avatar = '';
        try {
            $product = new Product();
            $product->title = $productDto->title;
            $product->slug = $productDto->title;
            $product->price = $productDto->price;
            $product->old_price = $productDto->old_price;
            $product->viewed = $productDto->viewed;
            $product->stars_rate = $productDto->stars_rate;
            $product->active = $productDto->active;
            $product->sort = $productDto->sort;
            $product->brand()->associate($productDto->brand);
            $product->save();
            $avatar = $this->storeProductAvatar($productDto, $product);
            $this->storeProductGallery($productDto, $product);
            $this->storeProductSections($productDto, $product);
            $this->storeProductTags($productDto, $product);
            $product->productDetails()->create(['description' => $productDto->description]);
            $product->img = $avatar;
            $product->save();
            DB::commit();

            return $product;

        } catch (\Exception $e) {
            DB::rollback();
            unlink(storage_path('app/' . $avatar));
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function updateProduct(ProductDto $productDto, Product $product): ?Product
    {
        DB::beginTransaction();

        $avatar = '';

        try {
            $product->title = $productDto->title;
            $product->slug = $productDto->title;
            $product->price = $productDto->price;
            $product->old_price = $productDto->old_price;
            $product->stars_rate = $productDto->stars_rate;
            $product->viewed = $productDto->viewed;
            $product->available_type = $productDto->available;
            $product->sort = $productDto->sort;
            $product->brand()->associate($productDto->brand);
            $product->save();

            if ($productDto->file) {
                $avatar = $this->storeProductAvatar($productDto, $product, true);

                $product->img = $avatar;
                $product->save();
            }

            $this->updateExistingGallery($productDto, $product);
            $this->storeProductGallery($productDto, $product);
            $this->storePopularBy($productDto, $product);
            $this->storeSlideGroups($productDto, $product);
            $this->storeProductDetails($productDto, $product);
            $this->storeProductSections($productDto, $product);
            $this->storeProductTags($productDto, $product);
            $this->storeSuggestedProducts($productDto, $product);

            DB::commit();

            return $product;

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            unlink(storage_path('app/' . $avatar));
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @param bool $update
     * @return string|null
     */
    private function storeProductAvatar(ProductDto $productDto, Product $product, bool $update = false): ?string
    {
        if (!$productDto->file) {
            return null;
        }

        $width = 570;
        $height = 326;

        if ($update) {
            $this->deleteOldAvatar($product);
        }

        $image = Image::make($productDto->file);

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $thumbnail_image_name = 'p_' . uniqid() . '_' . time() . '.' . $productDto->file->getClientOriginalExtension();
        $checkPath = storage_path('app/public/thumbnails/');

        if (!\Illuminate\Support\Facades\File::isDirectory($checkPath)) {
            \Illuminate\Support\Facades\File::makeDirectory($checkPath, 0777, true, true);
        }

        $image->save(storage_path('app/public/thumbnails/' . $thumbnail_image_name));

        $saved_image_uri = $image->dirname . '/' . $image->basename;

        $path = Storage::disk('public')
            ->putFileAs(
                "p/$product->slug/" . 'avatar',
                new File($saved_image_uri), $thumbnail_image_name
            );

        $image->destroy();
        unlink($saved_image_uri);

        return $path;

    }

    /**
     * @param Product $product
     * @return void
     */
    public function deleteOldAvatar(Product $product): void
    {
        $file = new Filesystem;
        $file->delete(storage_path('app/public/' . $product->img));
    }

    /**
     * @return array
     */
    private function getSavingSizes(): array
    {
        //todo: decide image sizes and move to config
        return [
            ['big' => ['height' => 800, 'width' => 1200]],
            ['small' => ['height' => 326, 'width' => 570]],
        ];
    }

    /**
     * @param Product $product
     * @param array $imageData
     * @return string
     */
    private function storeProductGalleryImage(Product $product, array $imageData, string $uniqId, int $time): string
    {
        $type = array_key_first($imageData['size']);
        $file = $imageData['image'];
        $image = Image::make($file);
        $image->resize($imageData['size'][$type]['width'], $imageData['size'][$type]['height'], function ($constraint) {
            $constraint->aspectRatio();
        });

        $thumbnail_image_name = 'p_' . $uniqId . '_' . $time . '.' . $file->getClientOriginalExtension();

        $image->save(storage_path('app/public/thumbnails/' . $thumbnail_image_name));

        $saved_image_uri = $image->dirname . '/' . $image->basename;

        Storage::disk('public')
            ->putFileAs(
                "p/$product->slug/" . "gallery/$type",
                new File($saved_image_uri), $thumbnail_image_name
            );

        $image->destroy();
        unlink($saved_image_uri);

        return $thumbnail_image_name;
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeProductGallery(ProductDto $productDto, Product $product): void
    {
        if (empty($productDto->gallery)) {
            return;
        }

        foreach ($productDto->gallery as $block => $gallery) {
            foreach ($gallery['images'] as $image) {
                $time = time();
                $uniqId = uniqid();
                foreach ($this->getSavingSizes() as $size) {
                    $imageData = ['size' => $size, 'image' => $image];

                    $galleryImage = $this->storeProductGalleryImage($product, $imageData, $uniqId, $time);
                    $galleryCreated = $product->gallery()->create(['type' => array_key_first($size), 'block' => $block, 'image' => $galleryImage]);

                    $galleryProperties = [];
                    $galleryProperties['color_id'] = $gallery['color']; //todo: remove if we dont need it
                    $galleryProperties['product_id'] = $product->getKey();
                    $galleryProperties['gallery_id'] = $galleryCreated->getKey();

                    foreach ($gallery['sizes'] as &$productSize) {
                        $galleryProperties['size_id'] = $productSize;
                        $product->productProperties()->create($galleryProperties);
                    }
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteProduct(Product $product): bool
    {
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/public/p/' . $product->slug));

        return $product->delete();
    }

    /**
     * @inheritDoc
     */
    public function toggleActive(Product $product): bool
    {
        $product->active = !$product->active;
        $product->save();

        return true;
    }

    /**
     * @param Product $product
     * @return array
     */
    public function getEditData(Product $product): array
    {
        $editData = [];
        foreach ($product->gallery as $gallery) {
            $editData[$gallery->block]['block'] = $gallery->block;
            $editData[$gallery->block]['images'][] = ['id' => $gallery->id, 'path' => $gallery->image];
            $sizes = [];
            foreach ($gallery->properties as $property) {
                $editData[$gallery->block]['color_id'] = $property->color_id;
                $sizes[] = $property->size_id;
            }
            $editData[$gallery->block]['sizes'] = $sizes;
        }

        return $editData;
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function updateExistingGallery(ProductDto $productDto, Product $product): void
    {
        $existingGalleryIds = $product->gallery()->pluck('block', 'id')->toArray();
        $idsByBlock = [];
        foreach ($existingGalleryIds as $id => $block) {
            $idsByBlock[$block][] = $id;
        }

        $galleryProperties = [];

        if (!$productDto->existing_gallery) {
            return;
        }

        $productGalleryRow = [];

        foreach ($productDto->existing_gallery as $block => $properties) {
            foreach ($properties['sizes'] as $size) {
                foreach ($idsByBlock[$block] as $galleryId) {
                    $productGalleryRow = [
                        'product_id' => $product->getKey(),
                        'gallery_id' => $galleryId,
                        'size_id' => $size,
                        'color_id' => $properties['color'],
                    ];
                    $galleryProperties[] = $productGalleryRow;
                }
            }
            if (isset($properties['images'])) {
                $this->addNewImageProductGallery(
                    $properties,
                    $productGalleryRow,
                    $product,
                    $block,
                );
            }
        }
        DB::transaction(function () use ($existingGalleryIds, $galleryProperties) {
            ProductProperty::whereIn('gallery_id', array_keys($existingGalleryIds))->delete();
            ProductProperty::insert($galleryProperties);
        });
    }

    /**
     * @param $properties
     * @param $productGalleryRow
     * @param $product
     * @param $block
     */
    public function addNewImageProductGallery($properties, $productGalleryRow, $product, $block)
    {
        foreach ($properties['images'] as $image) {
            $time = time();
            $uniqId = uniqid();
            foreach ($this->getSavingSizes() as $size) {

                $imageData = ['size' => $size, 'image' => $image];
                $galleryImage = $this->storeProductGalleryImage($product, $imageData, $uniqId, $time);
                $product->gallery()->create(['type' => array_key_first($size), 'block' => $block, 'image' => $galleryImage]);

                $product->productProperties()->create($productGalleryRow);
            }
        }
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storePopularBy(ProductDto $productDto, Product $product): void
    {
        if (!$productDto->popular_by) {
            $product->popularsBy()->delete();
            return;
        }

        $productDto->popular_by = array_map(function ($val) {
            return true;
        }, $productDto->popular_by);

        $product->popularsBy()->delete();
        $product->popularsBy()->create($productDto->popular_by);
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeSlideGroups(ProductDto $productDto, Product $product): void
    {
        $product->slideGroups()->sync($productDto->slide_groups);
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeProductDetails(ProductDto $productDto, Product $product): void
    {
        ProductDetail::updateOrCreate(
            ['product_id' => $product->getKey()],
            ['description' => $productDto->description, 'additional' => $productDto->additional, 'information' => $productDto->information]
        );
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeProductSections(ProductDto $productDto, Product $product): void
    {
        $product->sections()->sync($productDto->sections);
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeProductTags(ProductDto $productDto, Product $product): void
    {
        $product->tags()->sync($productDto->tags);
    }

    /**
     * @param ProductDto $productDto
     * @param Product $product
     * @return void
     */
    private function storeSuggestedProducts(ProductDto $productDto, Product $product): void
    {
        $product->suggestedProducts()->delete();
        $suggestedProducts = [];

        if (!$productDto->suggested_products) {
            return;
        }

        foreach ($productDto->suggested_products as $suggestedProduct) {
            $suggestedProducts[] = ['product_id' => $product->getKey(), 'suggested_id' => $suggestedProduct];
        }

        $product->suggestedProducts()->insert($suggestedProducts);
    }

    /**
     * @return int
     */
    public function getProductSortIsBigCount(): int
    {
        return Product::max('sort') ?? 1;
    }

}

