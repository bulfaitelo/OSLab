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
        Schema::create('venda_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('valor_custo', 9, 2);
            $table->decimal('valor_venda', 9, 2);
            $table->unsignedInteger('quantidade');
            $table->decimal('valor_custo_total', 9, 2);
            $table->decimal('valor_venda_total', 9, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_produtos');
    }
};
