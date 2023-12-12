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
        Schema::create('visite_quantifications', function (Blueprint $table) {
            $table->id('id_quantification');
            $table->unsignedBigInteger('id_quantificateur');
            $table->unsignedBigInteger('id_bosquet');
            $table->foreign('id_quantificateur')->references('id_quantificateur')->on('quantificateurs');
            $table->foreign('id_bosquet')->references('id_bosquet')->on('bosquets')->onDelete('cascade');
            $table->integer('nb_arbre');
            $table->string('type_arbre');
            $table->integer('nb_carbone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visite_quantifications');
    }
};
