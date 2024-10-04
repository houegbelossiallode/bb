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
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nombre');
            $table->decimal('ca', 15, 2);
            $table->foreignId('objectif_id')->constrained('objectifs')->onDelete('cascade');
            $table->foreignId('commercial_id')->constrained('commercials')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};
