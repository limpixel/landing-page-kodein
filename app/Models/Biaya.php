<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $table = "biayas";

    protected $fillable = [
        'id_lembaga',
        'image1',
        'image2',
        'image3',
        'image4',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'biayas', 'id', 'id_lembaga');
    }
}
