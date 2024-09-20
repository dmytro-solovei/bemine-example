<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class ProductsBySlideGroupResource
 * @package App\Http\Resources
 *
 */
class ProductsBySlideGroupResource extends JsonResource
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
            'description' => $this->resource->description,
            'old_price' => $this->resource->old_price,
            'price' => $this->resource->price,
            'avatar' => asset('storage/' . $this->resource->img),
        ];
    }


}
