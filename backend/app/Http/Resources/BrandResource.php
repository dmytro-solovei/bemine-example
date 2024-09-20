<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class BrandResource
 * @package App\Http\Resources
 *
 */
class BrandResource extends JsonResource
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
            'name' => $this->resource->name,
            'avatar' => asset('storage/' . $this->resource->avatar),
        ];
    }

}
