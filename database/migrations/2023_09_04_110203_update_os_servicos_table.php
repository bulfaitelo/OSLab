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
        Schema::table('os_servicos', function (Blueprint $table) {
            $table->foreign('os_id', 'fk_os_servicos_os')
                  ->references('id')
                  ->on('os')
                  ->cascadeOnDelete();

            $table->foreign('servico_id', 'fk_os_servicos_servicos')
                  ->references('id')
                  ->on('servicos');

            $table->foreign('user_id', 'fk_os_servicos_users')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os_servicos', function (Blueprint $table) {
            $table->dropForeign('fk_os_servicos_os');
            $table->dropForeign('fk_os_servicos_servicos');
            $table->dropForeign('fk_os_servicos_users');
        });
    }
};
