<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = "descriptions";

    protected $fillable = [
        'id_lembaga',
        'bgColor',
        'title',
        'description',
        'link',
        'image',
        'video',
        'position',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'descriptions', 'id', 'id_lembaga');
    }
}
