<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface TagService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface TagService
{

    /**
     * @return LengthAwarePaginator|null
     */
    public function getAllTags(): ?LengthAwarePaginator;

    /**
     * @param string $name
     * @return Tag
     */
    public function saveTag(string $name): Tag;

    /**
     * @param string $name
     * @param Tag $tag
     * @return Tag
     */
    public function updateTag(string $name, Tag $tag): Tag;

}
