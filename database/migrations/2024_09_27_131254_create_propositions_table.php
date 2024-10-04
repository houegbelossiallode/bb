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
        Schema::create('propositions', function (Blueprint $table) {
            $table->id();
            $table->jsonb('informationRequise');
            $table->unsignedInteger('reduction');
            $table->decimal('accessoire', 15, 2);
            $table->decimal('taxe', 15, 2);
            $table->decimal('primeTotale', 15, 2);
            $table->string('statut')->default('En traitement');
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('compagnie_id')->constrained('compagnies')->onDelete('cascade');
            $table->unique(['compagnie_id', 'offre_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propositions');
    }
};
