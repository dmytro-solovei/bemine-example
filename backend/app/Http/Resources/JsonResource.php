<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as JsonResourceBase;

/**
 * Class JsonResource
 * @package App\Http\Resources
 *
 */
class JsonResource extends JsonResourceBase
{
    /**
     * @var array
     */
    public $additional = [
        'meta'   => [],
        'status' => 'success',
    ];

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function addMeta(string $key, $value)
    {
        $this->additional['meta'][$key] = $value;
        return $this;
    }
}
