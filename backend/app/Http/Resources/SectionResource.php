<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * Class ChannelPlanResource
 * @package UserFeed\Http\Resources
 *
 */
class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' =>  $this->resource->id,
            'name' => $this->resource->name,
            'parent_id' => $this->resource->parent_id,
            'sub_sections' => SectionResource::collection($this->resource->subSections),
        ];
    }

}
