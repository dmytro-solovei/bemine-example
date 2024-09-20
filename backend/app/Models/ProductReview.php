<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $product_id
 * @property string $description
 * @property int like
 * @property int dislike
 * @property bool active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Product|null $product
 * @property User|null $user
 * @method  $this $active()
 */
class ProductReview extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'description',
        'like',
        'dislike',
        'active'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $obQuery
     * @return void
     */
    public function scopeActive($obQuery): void
    {
        $obQuery->where('active', true);
    }

}
