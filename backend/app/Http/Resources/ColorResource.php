<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class ColorResource
 * @package App\Http\Resources
 *
 */
class ColorResource extends JsonResource
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
            'code' => $this->resource->code,
            'description' => $this->resource->description
        ];
    }

}
