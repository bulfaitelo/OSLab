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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('name')->unique();
            $table->string('descricao')->nullable();
            $table->decimal('valor_custo', 9, 2)->nullable();
            $table->decimal('valor_venda', 9, 2);
            $table->integer('estoque')->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->unsignedBigInteger('centro_custo_id');
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
