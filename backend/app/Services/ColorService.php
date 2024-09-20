<?php

namespace App\Services;

use App\Classes\Contracts\Services\ColorService as ColorServiceContract;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ColorService
 * @package App\Services
 *
 */
class ColorService implements ColorServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllColors(): ?Collection
    {
        return Color::all();
    }


}
