<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $table = "testimonies";

    protected $fillable = [
        'id_lembaga',
        'image',
        'name',
        'description',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'testimonies', 'id', 'id_lembaga');
    }
}
