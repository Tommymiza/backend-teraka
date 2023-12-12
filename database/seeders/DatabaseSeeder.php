<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "nom"=>"Tommy Miza",
            "email"=>"tommymiza20@gmail.com",
            "phone"=>"0344824468",
            "adresse"=>"Tanambao Fianarantsoa",
            "password"=>"Teraka2023",
            "role"=>"Admin",
            "lieu"=>"Antananarivo"
        ]);

        \App\Models\Champion::create([
            "nom"=>"Tommy Miza",
            "email"=>"test@gmail.com",
            "phone"=>"0344824468",
            "adresse"=>"Tanambao Fianarantsoa",
            "password"=>"Champion1234",
            "lieu"=>"Antananarivo"
        ]);
    }
}
