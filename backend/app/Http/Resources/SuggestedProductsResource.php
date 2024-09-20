<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Classes\Enum\ProductGallerySizeEnum;
use App\Models\Product;
use App\Models\Size;

/**
 * Class SuggestedProductsResource
 * @package App\Http\Resources
 *
 */
class SuggestedProductsResource extends JsonResource
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
            'price' => $this->resource->price,
            'avatar' => asset('storage/' . $this->resource->img),
            'gallery' => $this->getGallery($this->resource),
            'details' => $this->resource->productDetails,
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
            $gallery->image = asset('storage/' . $gallery->image);
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

}
