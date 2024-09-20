<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $main_color
 * @property string $currency_value
 *
 */
class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'main_color',
        'currency_value',
    ];

}
