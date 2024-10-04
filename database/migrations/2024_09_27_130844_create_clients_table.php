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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('poste')->nullable();
            $table->string('statut');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('commercial_id')->constrained('commercials')->onDelete('cascade');
            $table->foreignId('entreprise_id')->nullable()->constrained('entreprises')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
