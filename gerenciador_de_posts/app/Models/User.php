<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];

    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
