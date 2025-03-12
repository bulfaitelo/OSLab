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
        Schema::table('categorias', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_categorias_users')
                ->references('id')->on('users');
            $table->foreign('garantia_id', 'fk_categorias_garantias')
                ->references('id')->on('garantias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign('fk_categorias_users');
            $table->dropForeign('fk_categorias_garantias');
        });
    }
};
