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
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->char('tipo'); // receita ou despesa
            $table->string('name');
            $table->unsignedBigInteger('os_id')->nullable();
            $table->unsignedBigInteger('venda_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('centro_custo_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('observacoes')->nullable();
            $table->decimal('valor', 9, 2);
            $table->date('data_quitacao')->nullable();
            $table->unsignedTinyInteger('parcelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
