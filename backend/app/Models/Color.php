<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $code
 * @property string $description
 *
 */
class Color extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'colors';

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
        'name',
        'code',
        'description'
    ];

}
