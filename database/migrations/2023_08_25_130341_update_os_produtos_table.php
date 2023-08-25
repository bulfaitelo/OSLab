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
        Schema::table('os_produtos', function (Blueprint $table) {
            $table->foreign('os_id', 'fk_os_produtos_os')
                  ->references('id')
                  ->on('os')
                  ->cascadeOnDelete();

            $table->foreign('produto_id', 'fk_os_produtos_produtos')
                  ->references('id')
                  ->on('produtos');

            $table->foreign('user_id', 'fk_os_produtos_users')
                  ->references('id')
                  ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os_produtos', function (Blueprint $table) {
            $table->dropForeign('fk_os_produtos_os');
            $table->dropForeign('fk_os_produtos_produtos');
            $table->dropForeign('fk_os_produtos_users');
        });
    }
};
