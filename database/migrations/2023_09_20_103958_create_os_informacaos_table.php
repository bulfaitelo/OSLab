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
        Schema::create('os_informacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('os_id');
            $table->unsignedBigInteger('user_id');
            $table->string('tipo');
            $table->string('descricao')->nullable();
            $table->string('tipo_informacao')->nullable();
            $table->string('informacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('os_informacaos');
    }
};
