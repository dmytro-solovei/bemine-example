<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $product_id
 * @property bool $best_seller
 * @property bool $top_rated
 * @property bool $new_arrival
 * @property Collection|null $products
 */
class PopularBy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'popular_by';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'best_seller',
        'new_arrival',
        'top_rated',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
