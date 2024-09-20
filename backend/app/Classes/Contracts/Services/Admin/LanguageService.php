<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface BrandService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface LanguageService
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Language
     */
    public function store(array $data): Language;

    /**
     * @param array $data
     * @param Language $language
     * @return bool
     */
    public function update(array $data, Language $language): bool;

    /**
     * @return Collection
     */
    public function getAllLanguages(): Collection;
}
