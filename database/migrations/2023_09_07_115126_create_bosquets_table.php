<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bosquets', function (Blueprint $table) {
            $table->id('id_bosquet');
            $table->unsignedBigInteger('id_pg');
            $table->unsignedBigInteger('id_membre');
            $table->foreign('id_membre')->references('id_membre')->on('membres')->onDelete('cascade');
            $table->string("nom_bosquet");
            $table->string("nom_proprietaire");
            $table->point('localisation');
            $table->integer('surface');
            $table->string('nb_arbre_initial');
            $table->boolean('avoir_arbre_teraka');
            $table->string('type_arbre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bosquets');
    }
};
