<?php
//todo: add stricts everywhere
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property string $name
 * @property string $email
 */
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
