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
        Schema::create('detailoffres', function (Blueprint $table) {
            $table->id();
            $table->jsonb('detailOffres');
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('garantie_id')->constrained('garanties')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailoffres');
    }
};
