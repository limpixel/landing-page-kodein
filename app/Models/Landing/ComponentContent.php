<?php

namespace App\Models\Landing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentContent extends Model
{
    use HasFactory;

    protected $table = "component_contents";

    protected $fillable = [
        "component_id",
        "title",
        "description",
        "image"
    ];
}
