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
        Schema::create('prepetitgroupes', function (Blueprint $table) {
            $table->id('id_pre');
            $table->string("nom", 100);
            $table->integer("age");
            $table->enum("genre", ['M', 'F']);
            $table->string("region", 100);
            $table->string("district", 100);
            $table->string("commune", 100);
            $table->string("fokontany", 100);
            $table->string("village", 100);
            $table->string("occupation", 100);
            $table->string("education", 100);
            $table->text("comment");
            $table->boolean("suivi_formation");
            $table->boolean("peut_former_pg");
            $table->boolean("plantation_teraka");
            $table->boolean("avoir_terrain");
            $table->string("phone", 20);
            $table->float("avis", 8, 2, true)->nullable();
            $table->text("commentaire")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_petit_groupes');
    }
};
