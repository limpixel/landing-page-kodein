<?php

namespace App\Models\landing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $tables = "landing_component";

    protected $fillable = [
        "title",
        "component_type_id",
        "order",
        "code"
    ];
}
