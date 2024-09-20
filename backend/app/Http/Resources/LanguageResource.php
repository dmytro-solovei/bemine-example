<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class UserResource
 * @package App\Http\Resources
 *
 */
class LanguageResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' =>  $this->resource->id,
            'name' => $this->resource->name,
        ];
    }

}
