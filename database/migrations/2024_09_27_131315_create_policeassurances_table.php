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
        Schema::create('policeassurances', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->string('duree');
            $table->date('debut');
            $table->date('fin');
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('proposition_id')->constrained('propositions')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policeassurances');
    }
};
