<?php

namespace App\Models;

use App\Classes\Enum\ProductGallerySizeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $product_id
 * @property string $type
 * @property int $color_id
 * @property string $image
 * @property int $block
 * @property Product|null $product

 */
    class ProductGallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_gallery';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'type',
        'color_id',
        'image',
        'block',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return HasMany
     */
    public function properties(): HasMany
    {
        // todo: change this class name to GalleryProperty
        return $this->hasMany(ProductProperty::class, 'gallery_id');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSmall(Builder $query): void
    {
        $query->where('type', ProductGallerySizeEnum::SMALL());
    }

}
