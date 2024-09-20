<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class PopularByResource
 * @package App\Http\Resources
 *
 */
class PopularByResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'product' => new ProductResource($this->resource->product),
            'brand' => new BrandResource($this->resource->product->brand),
            'best_seller' => $this->resource->best_seller,
            'top_rated' => $this->resource->top_rated,
            'new_arrival' => $this->resource->new_arrival
        ];
    }

}
