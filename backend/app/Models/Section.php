<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $name
 * @property int $section_id
 * @property Collection|Category|null $categories
 *
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 */
class Section extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'parent_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'name' => 'json'
    ];

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }


    /**
     * @return HasMany
     */
    public function subSections(): HasMany
    {
        return $this->hasMany(Section::class, 'parent_id')->with('subSections');
    }

    /**
     * @param $ids
     * @return mixed
     */
    public static function getchildSectionIdQuery($ids)
    {
        return self::select('id')
            ->whereIn('id', $ids)
            ->union(self::recursiveJoin($ids))
            ->distinct();
    }

    /**
     * @param $ids
     * @return Builder
     */
    private static function recursiveJoin($ids): Builder
    {
        $subquery = self::select('sections.id')
            ->join('sections as sub', 'sections.parent_id', '=', 'sub.id')
            ->whereIn('sub.id', $ids);

        return DB::table(DB::raw("({$subquery->toSql()}) as cte"))
            ->mergeBindings($subquery->getQuery())
            ->select('id');
    }

    /**
     * @return BelongsToMany
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'category_brand', 'category_id', 'brand_id');
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'category_size', 'category_id', 'size_id');
    }

    /**
     * @return BelongsTo
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_id');
    }

}
