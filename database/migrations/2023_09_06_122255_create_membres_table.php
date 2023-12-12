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
        Schema::create('membres', function (Blueprint $table) {
            $table->id('id_membre');
            $table->string('nom');
            $table->enum('genre', ['M', 'F']);
            $table->integer('age');
            $table->string('region');
            $table->string('district');
            $table->string('commune');
            $table->string('fokontany');
            $table->string('village');
            $table->string('occupation');
            $table->string('niveau_etude');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
