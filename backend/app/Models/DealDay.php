<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $product_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 */
class DealDay extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deal_day';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'start_date',
        'end_date',
    ];

    /**
     * @param $value
     * @return void
     */
    public function setDateStartAttribute($value): void {
        dd(123123);
        $this->attributes['date_start'] = date('d/m/Y H:i', strtotime($value) );
    }

    /**
     * @param $value
     * @return void
     */
    public function setDateEndAttribute($value): void {
        dd(123123);
        $this->attributes['date_end'] = date('d/m/Y H:i', strtotime($value) );
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
