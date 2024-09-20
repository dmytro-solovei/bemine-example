<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Classes\Enum\ProductGallerySizeEnum;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Ramsey\Collection\Collection;

/**
 * Class ProductResource
 * @package App\Http\Resources
 *
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'slug' => $this->resource->slug,
            'description' => $this->resource->productDetails->description,
            'available_type' => $this->resource->available_type,
            'old_price' => $this->resource->old_price,
            'stars_rate' => $this->resource->stars_rate,
            'price' => $this->resource->price,
            'sort' => $this->resource->sort,
            'avatar' => asset('storage/' . $this->resource->img),
            'gallery' => $this->getGallery($this->resource),
            'details' => $this->resource->productDetails,
            'suggested_products' => $this->getSuggestedProducts($request),
            'brand' => BrandResource::make($this->brand)
        ];
    }

    /**
     * @param Product $resource
     * @return array
     */
    private function getGallery(Product $resource): array
    {
        $blockGallery = [];
        foreach ($resource->gallery->where('type', ProductGallerySizeEnum::BIG()) as $gallery) {
            $gallery->image = asset('storage/p/'.$resource->slug.'/gallery/big/' . $gallery->image);
            $blockGallery[$gallery->block]['images'][] = ['id' => $gallery->id, 'image' => $gallery->image];
            $blockGallery[$gallery->block]['block'] = $gallery->block;
            $sizes = [];
            foreach ($gallery->properties as $property) {
                $blockGallery[$gallery->block]['color'] = new ColorResource($property->color);
                $sizes[] = new SizeResource(Size::findOrFail($property->size_id));
            }
            $blockGallery[$gallery->block]['sizes'] = $sizes;
        }

        return $blockGallery;
    }


    /**
     * @param Request $request
     * @return array|AnonymousResourceCollection
     */
    private function getSuggestedProducts(Request $request)
    {
        if (
            !(
                $request->route()->getName() === 'product.show'
                || $request->route()->getName() === 'deal-day.index'
            )
        ) {
            return [];
        }

        $suggestedProductsIds = $this->resource->suggestedProducts->toArray();
        $suggestedProducts = Product::whereIn('id', $suggestedProductsIds)->get();

        return SuggestedProductsResource::collection($suggestedProducts);
    }

}
