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
        Schema::table('contas', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_contas_users')
                ->references('id')->on('users');

            $table->foreign('centro_custo_id', 'fk_contas_centro_custos')
                ->references('id')->on('centro_custos');

            $table->foreign('cliente_id', 'fk_contas_clientes')
                ->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contas', function (Blueprint $table) {
            $table->dropForeign('fk_contas_users');
            $table->dropForeign('fk_contas_centro_custos');
            $table->dropForeign('fk_contas_clientes');
        });
    }
};
