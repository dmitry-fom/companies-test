<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $phone
 * @property $email
 * @property $api_token
 * @property $password
 */
class User extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email'
    ];

    protected $hidden = [
        'password',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }
}
