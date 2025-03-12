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
        Schema::table('checklists', function (Blueprint $table) {
            $table->foreign('categoria_id', 'fk_checklists_categorias')
                ->references('id')->on('categorias');

            $table->foreign('user_id', 'fk_checklists_users')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checklists', function (Blueprint $table) {
            $table->dropForeign('fk_checklists_categorias');
            $table->dropForeign('fk_checklists_users');
        });
    }
};
