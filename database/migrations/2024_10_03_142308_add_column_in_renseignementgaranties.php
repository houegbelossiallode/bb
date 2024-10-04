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
        Schema::table('renseignementgaranties', function (Blueprint $table) {
            // Ajouter la nouvelle clé étrangère
            $table->unsignedBigInteger('compagnie_id');
            $table->foreign('compagnie_id')->references('id')->on('compagnies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renseignementgaranties', function (Blueprint $table) {
            // Supprimer la nouvelle clé étrangère et la colonne
            $table->dropForeign(['compagnie_id']);
            $table->dropColumn('compagnie_id');
        });
    }
};
