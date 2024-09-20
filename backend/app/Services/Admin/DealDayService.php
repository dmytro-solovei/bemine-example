<?php

namespace App\Services\Admin;

use App\Classes\Contracts\Services\Admin\DealDayService as DealDayServiceContract;
use App\Models\DealDay;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DealDayService
 * @package App\Services\Admin
 *
 */
class DealDayService implements DealDayServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllDealDays($all = false): ?LengthAwarePaginator
    {
        return DealDay::with('product')->paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function saveDealDay(array $deals): bool
    {
        foreach ($deals as &$deal) {
            $deal['date_start'] = Carbon::createFromFormat('d/m/Y H:i', $deal['date_start']);
            $deal['date_end'] = Carbon::createFromFormat('d/m/Y H:i', $deal['date_end']);
        }

        DealDay::insert($deals);

        return true;

    }

    /**
     * @inheritDoc
     */
    public function deleteDealDay(DealDay $dealDay): bool
    {
        $dealDay->delete();

        return true;
    }

}
