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
        Schema::create('visite_baselines', function (Blueprint $table) {
            $table->id('id_visite_baseline');
            $table->unsignedBigInteger('id_bosquet');
            $table->unsignedBigInteger('id_quantificateur');
            $table->foreign('id_bosquet')->references('id_bosquet')->on('bosquets')->onDelete('cascade');
            $table->foreign('id_quantificateur')->references('id_quantificateur')->on('quantificateurs');
            $table->integer('surface');
            $table->point('localisation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visite_baselines');
    }
};
