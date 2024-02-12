<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Quantificateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "id_quantificateur";

    protected $fillable = [
        "nom",
        "email",
        "adresse",
        "phone",
        "password",
        "photo"
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
}
