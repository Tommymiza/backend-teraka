<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "age",
        "genre",
        "region",
        "district",
        "commune",
        "fokontany",
        "village",
        "occupation",
        "niveau_etude",
        "avoir_terrain",
        "email",
        "phone",
        "note"
    ];
}
