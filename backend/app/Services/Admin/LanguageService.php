<?php

namespace App\Services\Admin;
use App\Classes\Contracts\Services\Admin\LanguageService as LanguageServiceInterface;
use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BrandService
 * @package App\Services\Admin
 *
 */
class LanguageService implements LanguageServiceInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Language::query()->paginate(10);
    }

    /**
     * @param array $data
     * @return Language
     */
    public function store(array $data): Language
    {
        return Language::create($data);
    }

    /**
     * @param array $data
     * @param Language $language
     * @return bool
     */
    public function update(array $data, Language $language): bool
    {
        return $language->update($data);
    }

    /**
     * @return Collection
     */
    public function getAllLanguages(): Collection
    {
        return Language::all();
    }
}
