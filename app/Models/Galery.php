<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $table = "galeries";

    protected $fillable = [
        'id_lembaga',
        'image',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'galeries', 'id', 'id_lembaga');
    }
}
