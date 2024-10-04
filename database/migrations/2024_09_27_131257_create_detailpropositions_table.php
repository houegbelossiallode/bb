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
        Schema::create('detailpropositions', function (Blueprint $table) {
            $table->id();
            $table->jsonb('detailPropositions');
            $table->decimal('prime', 15, 2);
            $table->decimal('surPrime', 15, 2);
            $table->foreignId('proposition_id')->constrained('propositions')->onDelete('cascade');
            $table->foreignId('detailoffre_id')->constrained('detailoffres')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpropositions');
    }
};
