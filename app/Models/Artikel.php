<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'category_id',
        'title',
        'slug',
        'image',
        'description',
        'content',
        'views',
    ];
}
