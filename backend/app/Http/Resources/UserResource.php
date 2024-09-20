<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class UserResource
 * @package App\Http\Resources
 *
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //todo: im admin, merge more columns

        return [
            'id' =>  $this->resource->id,
            'name' => $this->resource->name,
            'avatar' => $this->resource->avatar,
            'verified' => $this->resource->verified,
            'active' => $this->resource->active,
            'address' => $this->resource->address
        ];
    }

}
