<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keunggulan extends Model
{
    use HasFactory;

    protected $table = "keunggulans";

    protected $fillable = [
        'id_lembaga',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'biayas', 'id', 'id_lembaga');
    }
}
