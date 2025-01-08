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
        Schema::table('vendas', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_venda_users')
            ->references('id')->on('users');

            $table->foreign('cliente_id', 'fk_venda_clientes')
            ->references('id')->on('clientes');

            $table->foreign('vendedor_id', 'fk_venda_users_vendedor')
            ->references('id')->on('users');

            $table->foreign('status_id', 'fk_venda_status')
            ->references('id')->on('status');
        });

        Schema::table('contas', function (Blueprint $table) {
            $table->foreign('venda_id', 'fk_contas_vendas')
            ->references('id')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign('fk_venda_users');
            $table->dropForeign('fk_venda_clientes');
            $table->dropForeign('fk_venda_users_vendedor');
        });

        Schema::table('contas', function (Blueprint $table) {
            $table->dropForeign('fk_contas_vendas');
        });
    }
};
