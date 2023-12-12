<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prepetitgroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "age",
        "genre",
        "education",
        "occupation",
        "region",
        "district",
        "commune",
        "fokontany",
        "village",
        "comment",
        "suivi_formation",
        "peut_former_pg",
        "plantation_teraka",
        "avoir_terrain",
        "phone"
    ];
}
