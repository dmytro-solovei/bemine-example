<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\Slide;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SlideService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface SlideService
{

    /**
     * @return Collection|null
     */
    public function getAllSlides(): ?Collection;

    /**
     * @param string $name
     * @param bool $active
     * @return Slide
     */
    public function saveSlideGroup(string $name, bool $active): Slide;

    /**
     * @param Slide $slide
     * @param string $name
     * @param bool $active
     * @return Slide
     */
    public function updateSlideGroup(Slide $slide, string $name, bool $active): Slide;

}
