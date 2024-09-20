<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\SlideService as SlideServiceContract;
use App\Models\Brand;
use App\Models\Slide;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SlideService
 * @package App\Services\Admin
 *
 */
class SlideService implements SlideServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllSlides(): ?Collection
    {
        return Slide::all();
    }

    /**
     * @inheritDoc
     */
    public function saveSlideGroup(string $name, bool $active): Slide
    {
        return Slide::create([
            'name' => $name,
            'active' => $active,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function updateSlideGroup(Slide $slide, string $name, bool $active): Slide
    {
        $slide->name = $name;
        $slide->active = $active;
        $slide->save();

        return $slide;
    }

}
