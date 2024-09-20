<?php
declare(strict_types=1);

namespace App\Http\Resources;

/**
 * Class SettingResource
 * @package App\Http\Resources
 *
 */
class SettingResource extends JsonResource
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
            'main_color' => $this->resource->main_color,
            'currency_value' => $this->resource->currency_value,
        ];
    }

}
