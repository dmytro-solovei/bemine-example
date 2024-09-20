<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class SizeResource
 * @package App\Http\Resources
 *
 */
class SizeResource extends JsonResource
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
            'description' => $this->resource->description,
        ];
    }

}
