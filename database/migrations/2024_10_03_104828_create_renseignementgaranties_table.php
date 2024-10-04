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
        Schema::create('renseignementgaranties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valeur');
            $table->foreignId('informationgarantie_id')->constrained('informationgaranties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renseignementgaranties');
    }
};
