<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "locations";

    protected $fillable = [
        'id_lembaga',
        'map',
        'description',
        'image1',
        'image2',
        'image3',
        'buttonText1',
        'buttonLink1',
        'buttonText2',
        'buttonLink2',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'locations', 'id', 'id_lembaga');
    }
}
