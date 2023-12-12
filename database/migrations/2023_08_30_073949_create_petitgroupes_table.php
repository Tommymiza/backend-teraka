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
        Schema::create('petitgroupes', function (Blueprint $table) {
            $table->id('id_pg');
            $table->integer("id_champion");
            $table->integer('id_staff_verificateur')->nullable();
            $table->string('nom_pg');
            $table->string('region');
            $table->string('district');
            $table->string('commune');
            $table->string('fokontany');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('phone3');
            $table->string('photo_pg');
            $table->boolean('issue_famille_different');
            $table->boolean('suivi_formation');
            $table->boolean('avoir_terrain_pepiniere');
            $table->integer('nb_semis')->default(0);
            $table->text('type_semis')->nullable();
            $table->string('photo_pepiniere')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitgroupes');
    }
};
