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
        Schema::table('os', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_os_users')
            ->references('id')->on('users');

            $table->foreign('cliente_id', 'fk_os_clientes')
            ->references('id')->on('clientes');

            $table->foreign('tecnico_id', 'fk_os_users_tecnico')
            ->references('id')->on('users');

            $table->foreign('status_id', 'fk_os_os_status')
            ->references('id')->on('os_status');

            $table->foreign('termo_garantia_id', 'fk_os_garantias')
            ->references('id')->on('garantias');

            $table->foreign('modelo_id', 'fk_os_wiki_models')
            ->references('id')->on('wiki_models');

            $table->foreign('categoria_id', 'fk_os_categoria_os')
            ->references('id')->on('categoria_os');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os', function (Blueprint $table) {
            $table->dropForeign('fk_os_users');
            $table->dropForeign('fk_os_clientes');
            $table->dropForeign('fk_os_users_tecnico');
            $table->dropForeign('fk_os_os_status');
            $table->dropForeign('fk_os_garantias');
            $table->dropForeign('fk_os_wiki_models');
            $table->dropForeign('fk_os_categoria_os');

        });
    }
};
