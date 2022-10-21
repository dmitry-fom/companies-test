<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property $id
 * @property $title
 * @property $description
 * @property $phone
 * @property $user_id
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'title',
        'description',
        'phone',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
