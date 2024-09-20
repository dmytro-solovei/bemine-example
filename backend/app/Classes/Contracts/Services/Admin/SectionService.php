<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface SectionService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface SectionService
{

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection|null
     */
    public function getAllSections(bool $all = false);

    /**
     * @param array $data
     * @return Section
     */
    public function saveSection(array $data): Section;

    /**
     * @param array $data
     * @param Section $section
     * @return Section
     */
    public function updateSection(array $data, Section $section): Section;


    /**
     * @param Section $section
     * @return bool
     */
    public function delete(Section $section): bool;

    /**
     * @param Section $section
     * @return bool
     */
    public function checkCanBeDeleted(Section $section): bool;

    /**
     * @param int $id
     * @return Section
     */
    public function getSection(int $id): Section;
}
