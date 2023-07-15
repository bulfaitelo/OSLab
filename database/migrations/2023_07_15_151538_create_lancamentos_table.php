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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('os_id')->nullable();
            $table->unsignedBigInteger('venda_id')->nullable();
            $table->unsignedBigInteger('centro_custo_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('tipo_lancamento');
            $table->string('cliente');
            $table->string('observacoes')->nullable();
            $table->decimal('valor', 9, 2);
            $table->date('vencimento')->nullable();
            $table->date('quitacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
