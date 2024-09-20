<?php

namespace App\Services;

use App\Classes\Contracts\Services\SizeService as SizeServiceContract;
use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SizeService
 * @package UserFeed\Services
 *
 */
class SizeService implements SizeServiceContract
{

    /**
     * @inheritDoc
     */
    public function getSizes(): ?Collection
    {
        return Size::all();
    }

    public function createSize()
    {
        // TODO: Implement createSize() method.
    }
}
