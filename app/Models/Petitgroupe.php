<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petitgroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_champion",
        "id_staff_verificateur",
        "nom_pg",
        "region",
        "district",
        "commune",
        "fokontany",
        "phone1",
        "phone2",
        "phone3",
        "photo_pg",
        "issue_famille_different",
        "suivi_formation",
        "avoir_terrain_pepiniere",
        "nb_semis",
        "type_semis",
        "photo_pepiniere",
    ];
}
