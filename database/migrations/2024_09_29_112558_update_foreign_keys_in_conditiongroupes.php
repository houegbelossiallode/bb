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
        Schema::table('conditiongroupes', function (Blueprint $table) {
            // Ajouter la nouvelle clé étrangère
            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conditiongroupes', function (Blueprint $table) {
            // Supprimer la nouvelle clé étrangère et la colonne
            $table->dropForeign(['produit_id']);
            $table->dropColumn('produit_id');
        });
    }
};
