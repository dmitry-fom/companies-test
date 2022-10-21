<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $token
 * @property $email
 */
class PasswordRecovery extends Model
{
    protected $table = 'password_recovery';

    protected $fillable = [
        'token',
        'email',
    ];
}
