<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $table = "headers";

    protected $fillable = [
        'id_lembaga',
        'buttonText',
        'buttonLink',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'headers', 'id', 'id_lembaga');
    }
}
