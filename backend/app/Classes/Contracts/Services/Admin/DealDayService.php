<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services\Admin;

use App\Models\DealDay;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

/**
 * Interface DealDayService
 * @package App\Classes\Contracts\Services\Admin
 *
 */
interface DealDayService
{

    /**
     * @return LengthAwarePaginator|null|LazyCollection
     */
    public function getAllDealDays($all = false);

    /**
     * @param array $deals
     * @return bool
     */
    public function saveDealDay(array $deals): bool;

    /**
     * @param DealDay $dealDay
     * @return bool
     */
    public function deleteDealDay(DealDay $dealDay): bool;

}
