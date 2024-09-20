<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\ColorService as ColorServiceContract;
use App\Classes\Dto\Admin\ColorDto;
use App\Models\Color;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BrandService
 * @package App\Services\Admin
 *
 */
class ColorService implements ColorServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllColors(): ?LengthAwarePaginator
    {
        return Color::paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function saveColor(ColorDto $colorDto): Color
    {
        return Color::create([
            'name' => $colorDto->name,
            'code' => $colorDto->code,
            'description' => $colorDto->description,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function updateColor(ColorDto $colorDto, Color $color): Color
    {
        $color->name = $colorDto->name;
        $color->code = $colorDto->code;
        $color->description = $colorDto->description;
        $color->save();

        return $color;
    }

}
