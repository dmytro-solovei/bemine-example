<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Classes\Dto\Admin\BrandDto;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface PopularByService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface PopularByService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllPopularTypes($all = false);

}
