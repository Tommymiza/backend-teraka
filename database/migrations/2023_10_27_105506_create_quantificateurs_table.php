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
        Schema::create('quantificateurs', function (Blueprint $table) {
            $table->id('id_quantificateur');
            $table->string('nom');
            $table->string('adresse');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quantificateurs');
    }
};
