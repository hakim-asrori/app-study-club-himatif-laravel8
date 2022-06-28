<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
    ];

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'id_class');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_category');
    }
}
