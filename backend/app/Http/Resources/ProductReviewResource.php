<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;

/**
 * Class ProductReviewResource
 * @package App\Http\Resources
 *
 */
class ProductReviewResource extends JsonResource
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
            'user' =>  new UserResource(User::find($this->resource->user_id)),
            'product_id' => new UserResource(User::find($this->resource->product_id)),
            'description' => $this->resource->description
        ];
    }

}
