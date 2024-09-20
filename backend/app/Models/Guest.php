<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $phone
 * @property int $active
 * @property Collection|ProductOrder|null $orders
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 */
class Guest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
    ];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(GuestProduct::class);
    }

}
