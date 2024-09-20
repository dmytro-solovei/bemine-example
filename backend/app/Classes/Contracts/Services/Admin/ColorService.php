<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\ColorDto;
use App\Models\Color;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface ColorService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface ColorService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllColors();

    /**
     * @param ColorDto $colorDto
     * @return Color
     */
    public function saveColor(ColorDto $colorDto): Color;

    /**
     * @param ColorDto $colorDto
     * @param Color $color
     * @return Color
     */
    public function updateColor(ColorDto $colorDto, Color $color): Color;

}
