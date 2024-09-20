<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\SizeService as SizeServiceContract;
use App\Classes\Dto\Admin\SizeDto;
use App\Models\Category;
use App\Models\Section;
use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class SizeService
 * @package App\Services\Admin
 *
 */
class SizeService implements SizeServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllSizes(): ?LengthAwarePaginator
    {
        return Size::paginate(50);
    }

    /**
     * @inheritDoc
     */
    public function saveSize($data): Size
    {
        $size = Size::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        $size->categories()->attach($data->categories);

        return $size;
    }

    /**
     * @inheritDoc
     */
    public function updateSize(SizeDto $sizeDto, Size $size): Size
    {
        $size->name = $sizeDto->name;
        $size->description = $sizeDto->description;
        $size->save();

        $size->categories()->sync($sizeDto->categories);

        return $size;
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return Section::whereNull('parent_id')->with('subSections')->get();
    }

    /**
     * @param $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function getSize($id): Size
    {
        return Size::with('categories')->findOrFail($id);
    }

}
