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
        Schema::table('liaisons', function (Blueprint $table) {
            $table->dropForeign(['condition_id']);
            $table->dropColumn('condition_id');

            // Ajouter la nouvelle clé étrangère
            $table->unsignedBigInteger('conditionvaleur_id');
            $table->foreign('conditionvaleur_id')->references('id')->on('conditionvaleurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liaisons', function (Blueprint $table) {
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');

            // Supprimer la nouvelle clé étrangère et la colonne
            $table->dropForeign(['conditionvaleur_id']);
            $table->dropColumn('conditionvaleur_id');
        });
    }
};
