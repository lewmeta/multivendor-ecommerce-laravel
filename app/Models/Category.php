<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'position',
        'image',
        'icon',
        'is_featured',
        'is_active',
    ];
}