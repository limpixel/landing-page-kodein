<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $table = "carousels";

    protected $fillable = [
        'id_lembaga',
        'title',
        'buttonText1',
        'buttonLink1',
        'buttonText2',
        'buttonLink2',
        'image',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'carousels', 'id', 'id_lembaga');
    }
}
