<?php

namespace App\Classes\Dto\Admin;

use App\Classes\Dto\DataTransferObject;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;

/**
 * Class UserDto
 * @package App\Classes\Dto
 *
 */
class BrandDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    public array $categories;

    /**
     * @var bool
     */
    public bool $active;

    /**
     * @var Brand
     */
    public Brand $brand;

    public ?UploadedFile $file = null;

}
