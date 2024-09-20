<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class DealDayResource
 * @package App\Http\Resources
 *
 */
class DealDayResource extends JsonResource
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
            'date_start' => $this->resource->date_start,
            'date_end' => $this->resource->date_end,
        ];
    }

}
