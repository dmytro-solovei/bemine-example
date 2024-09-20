<?php

namespace App\Classes\Dto\Admin;

use Spatie\DataTransferObject\DataTransferObject;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductDto
 * @package App\Classes\Dto
 *
 */
class ProductDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $title;

    public Brand $brand;

    public ?UploadedFile $file = null;

    /**
     * @var float|null
     */
    public ?float $old_price = null;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var int
     */
    public int $viewed;

    /**
     * @var int|null
     */
    public ?int $stars_rate = 1;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var string|null
     */
    public ?string $available = null;

    /**
     * @var bool|null
     */
    public ?bool $active = null;

    /**
     * @var array|null
     */
    public ?array $gallery = null;

    /**
     * @var array|null
     */
    public ?array $existing_gallery = null;

    /**
     * @var array|null
     */
    public ?array $popular_by = null;

    /**
     * @var array|null
     */
    public ?array $slide_groups = null;

    /**
     * @var array|null
     */
    public ?array $additional = null;

    /**
     * @var array|null
     */
    public ?array $information = null;

    /**
     * @var array
     */
    public array $sections;

    /**
     * @var array|null
     */
    public ?array $tags = null;

    /**
     * @var array|null
     */
    public ?array $suggested_products = null;

    /**
     * @var int|null
     */
    public ?int $sort = null;
}
