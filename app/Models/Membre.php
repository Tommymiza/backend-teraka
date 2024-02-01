<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_pg",
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
        "email",
        "phone",
        "note"
    ];
}
