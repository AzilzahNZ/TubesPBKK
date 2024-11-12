<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_role extends Model
{
    protected $fillable = [
        'title',
        'link',
        'icon',
        'role'
    ];
}
