<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\BrandService as BrandServiceContract;
use App\Classes\Dto\Admin\BrandDto;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class BrandService
 * @package App\Services\Admin
 *
 */
class BrandService implements BrandServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllBrands($all = false)
    {
        if ($all) {
            return Brand::cursor();
        }

        return Brand::paginate(10);
    }

    /**
     * @param $data
     * @param UploadedFile $file
     * @return Brand|null
     */
    public function saveBrand($data, UploadedFile $file): ?Brand
    {
        DB::beginTransaction();

        $avatar = '';

        try {
            $avatar = $this->storeBrandAvatar($data->name, $file);

            $brand = new Brand();
            $brand->name = $data->name;
            $brand->avatar = $avatar;
            $brand->save();

            $brand->categories()->sync($data->categories);

            DB::commit();

            return $brand;

        } catch (\Exception $e) {
            DB::rollback();
            unlink(storage_path('app/' . $avatar));
        }

        return null;

    }

    /**
     * @inheritDoc
     */
    public function updateBrand(BrandDto $brandDto): ?Brand
    {
        DB::beginTransaction();

        $avatar = '';

        try {

            if ($brandDto->file) {
                $avatar = $this->storeBrandAvatar($brandDto->name, $brandDto->file, true);
                $brandDto->brand->avatar = $avatar;
            }
            $brandDto->brand->name = $brandDto->name;
            $brandDto->brand->save();
            $brandDto->brand->categories()->sync($brandDto->categories);

            DB::commit();

            return $brandDto->brand;

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            unlink(storage_path('app/' . $avatar));
        }

        return null;
    }


    /**
     * @param string $brand
     * @param UploadedFile $file
     * @param bool $update
     * @return string|null
     */
    private function storeBrandAvatar(string $brand, UploadedFile $file, bool $update = false): ?string
    {
        if (!$file) {
            return null;
        }

        if ($update) {
            $this->deleteOldAvatar($brand);
        }

        $image = Image::make($file);
        $image->resize(570, 326, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnail_image_name = 'brand_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        $checkPath = storage_path('app/public/thumbnails/');

        if (!\Illuminate\Support\Facades\File::isDirectory($checkPath)) {
            \Illuminate\Support\Facades\File::makeDirectory($checkPath, 0777, true, true);
        }

        $image->save(storage_path('app/public/thumbnails/' . $thumbnail_image_name));
        $saved_image_uri = $image->dirname . '/' . $image->basename;

        $path = Storage::disk('public')->putFileAs('brands/' . $brand, new File($saved_image_uri), $thumbnail_image_name);

        $image->destroy();
        unlink($saved_image_uri);

        return $path;

    }

    /**
     * @param string $brand
     * @return void
     */
    public function deleteOldAvatar(string $brand): void
    {
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/public/brands/' . $brand));
    }

    /**
     * @inheritDoc
     */
    public function toggleActive(Brand $brand): bool
    {
        $brand->active = !$brand->active;
        return $brand->save();
    }

    /**
     * @param Brand $brand
     * @return bool
     */
    public function deleteBrand(Brand $brand): bool
    {
        return DB::transaction(function () use ($brand) {

            $this->deleteBrandFolder($brand);

            return $brand->delete();

        }, 5);

    }

    /**
     * @param Brand $brand
     * @void
     */
    private function deleteBrandFolder(Brand $brand): void
    {
        $file = new Filesystem;
        $file->deleteDirectory(storage_path('app/public/brands/' . $brand->name));
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
     * @return Brand
     */
    public function getBrand($id): Brand
    {
        return Brand::findOrFail($id);
    }
}
