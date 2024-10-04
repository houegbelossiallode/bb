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
        Schema::create('informationgaranties', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nom');
            $table->jsonb('options')->nullable();
            $table->integer('ordre')->nullable();
            $table->string('etat');
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
        Schema::dropIfExists('informationgaranties');
    }
};
