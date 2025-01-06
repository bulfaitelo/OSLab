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
        Schema::table('venda_produtos', function (Blueprint $table) {
            $table->foreign('venda_id', 'fk_venda_produtos_venda')
                  ->references('id')
                  ->on('vendas')
                  ->cascadeOnDelete();

            $table->foreign('produto_id', 'fk_venda_produtos_produtos')
                  ->references('id')
                  ->on('produtos');

            $table->foreign('user_id', 'fk_venda_produtos_users')
                  ->references('id')
                  ->on('users');
        });

        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->foreign('venda_produto_id', 'fk_movimentacaos_venda_produtos')
            ->references('id')->on('venda_produtos');

            $table->foreign('venda_id', 'fk_movimentacaos_venda')
            ->references('id')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venda_produtos', function (Blueprint $table) {
            $table->dropForeign('fk_venda_produtos_venda');
            $table->dropForeign('fk_venda_produtos_produtos');
            $table->dropForeign('fk_venda_produtos_users');
        });

        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->dropForeign('fk_movimentacaos_venda');
            $table->dropForeign('fk_movimentacaos_venda_produtos');
        });
    }
};
