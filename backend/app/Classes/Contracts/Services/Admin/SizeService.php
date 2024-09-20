<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\SizeDto;
use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface SizeService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface SizeService
{
    /**
     * @return LengthAwarePaginator|null
     */
    public function getAllSizes(): ?LengthAwarePaginator;

    /**
     * @param $data
     * @return Size
     */
    public function saveSize($data): Size;

    /**
     * @param SizeDto $sizeDto
     * @param Size $size
     * @return Size
     */
    public function updateSize(SizeDto $sizeDto, Size $size): Size;

    /**
     * @return Collection
     */
    public function getCategories(): Collection;

    /**
     * @param $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function getSize($id): Size;

}
