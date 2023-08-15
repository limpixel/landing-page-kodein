<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $table = "landing_pages";

    protected $fillable = [
        'id_lembaga',
        'domain',
        'logo',
        'whatsapp',
        'instagram',
        'facebook',
        'youtube',
    ];

    public function idLembaga(){
        return $this->belongsToMany(Lembaga::class,'landing_pages', 'id', 'id_lembaga');
    }
}
