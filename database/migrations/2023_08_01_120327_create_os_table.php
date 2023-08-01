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
        Schema::create('os', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->unsignedBigInteger('status_id');
            $table->date('data_inicial');
            $table->date('data_final')->nullable();
            $table->date('prazo_garantia')->nullable();
            $table->unsignedBigInteger('termo_garantia_id')->nullable();
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->string('serial')->nullable();
            $table->string('descricao')->nullable();
            $table->string('defeito')->nullable();
            $table->string('observacoes')->nullable();
            $table->string('laudo')->nullable();
            $table->json('checklist')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('os');
    }
};
