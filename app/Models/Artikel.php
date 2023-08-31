<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = "artikels";

    protected $fillable = [
        'status',
        'user_id',
        'category_id',
        'id_lembaga',
        'title',
        'slug',
        'image',
        'description',
        'content',
        'views',
    ];

    public function userID(){
        return $this->belongsToMany(User::class, 'artikels','id', 'user_id');
    }

    public function lembagaID(){
        return $this->belongsToMany(Lembaga::class,'artikels','id', 'id_lembaga');
    }

    public function categoryID(){
        return $this->belongsToMany(Categories::class, 'artikels', 'id', 'category_id');
    }

}
