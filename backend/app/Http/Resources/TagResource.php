<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class TagResource
 * @package App\Http\Resources
 *
 */
class TagResource extends JsonResource
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
        ];
    }

}
