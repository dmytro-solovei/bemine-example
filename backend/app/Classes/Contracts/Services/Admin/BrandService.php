<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\BrandDto;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

/**
 * Interface BrandService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface BrandService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllBrands($all = false);

    /**
     * @param $data
     * @param UploadedFile $file
     * @return Brand|null
     */
    public function saveBrand($data, UploadedFile $file): ?Brand;

    /**
     * @param BrandDto $brandDto
     * @return Brand|null
     */
    public function updateBrand(BrandDto $brandDto): ?Brand;

    /**
     * @param Brand $brand
     * @return bool
     */
    public function toggleActive(Brand $brand):bool;

    /**
     * @param Brand $brand
     * @return bool
     */
    public function deleteBrand(Brand $brand): bool;

    /**
     * @return Collection
     */
    public function getCategories(): Collection;

    /**
     * @param $id
     * @return Brand
     */
    public function getBrand($id): Brand;

}
