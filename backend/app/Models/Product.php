<?php

namespace App\Models;

use App\Classes\Enum\ProductGallerySizeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $available_type
 * @property string $img
 * @property float $old_price
 * @property int $stars_rate
 * @property float $price
 * @property int $viewed
 * @property bool $active
 * @property Collection|null $section
 * @property Collection|null $category
 * @property Brand|null $brand
 * @property HasMany|Collection|null $gallery
 * @property HasMany|Collection|null $productProperties
 * @property HasOne|Collection|null $popularsBy
 * @property BelongsToMany|Collection|null $tags
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @method  $this $findByName()
 * @method  $this $active()
 * @methodc $this $suggestedProducts()
 *
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'img',
        'old_price',
        'price',
        'viewed',
        'active',
        'available_type',
        'stars_rate',
        'sort',
    ];

    /**
     * @param string $sValue
     */
    public function setSlugAttribute(string $sValue)
    {
        if (!empty($this->attributes['slug'])) {
            return;
        }

        if ($this->whereSlug($sSlug = Str::slug($sValue))->exists()) {

            $sSlug = $this->incrementSlug($sSlug);
        }

        $this->attributes['slug'] = $sSlug;
    }

    /**
     * @param string $sSlug
     * @return string
     */
    public function incrementSlug(string $sSlug): string
    {
        $sOriginal = $sSlug;

        $iCount = 2;

        while ($this->whereSlug($sSlug)->exists()) {

            $sSlug = "{$sOriginal}-" . $iCount++;
        }

        return $sSlug;
    }


    /**
     * @param $obQuery
     * @param string $sSearchName
     * @return void
     */
    public function scopeFindByName($obQuery, string $sSearchName): void
    {
        $sSearchName = \filter_var($sSearchName, FILTER_SANITIZE_STRING);
        $obQuery->where('title', 'like', "%{$sSearchName}%");
    }

    /**
     * @param $obQuery
     * @return void
     */
    public function scopeActive($obQuery): void
    {
        $obQuery->where('active', true);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    /**
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    /**
     * @return HasMany
     */
    public function smallImageGallery(): HasMany
    {
        return $this->hasMany(ProductGallery::class)
            ->where('type', ProductGallerySizeEnum::SMALL());
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSmall(Builder $query)
    {
        $query->where('type', ProductGallerySizeEnum::SMALL());
    }

    /**
     * @return HasMany
     */
    public function productProperties(): HasMany
    {
        return $this->hasMany(ProductProperty::class);
    }

    /**
     * @return HasOne
     */
    public function popularsBy(): HasOne
    {
        return $this->hasOne(PopularBy::class);
    }

    /**
     * @return BelongsToMany
     */
    public function slideGroups(): BelongsToMany
    {
        return $this->belongsToMany(Slide::class, 'product_slide');
    }

    /**
     * @return HasOne
     */
    public function productDetails(): HasOne
    {
        return $this->hasOne(ProductDetail::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return HasMany
     */
    public function suggestedProducts(): HasMany
    {
        return $this->hasMany(SuggestedProduct::class);
    }

}
