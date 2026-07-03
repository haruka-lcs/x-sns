<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'user_name',
        'account_id',
        'password',
        'profile_image',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}