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
        Schema::table('checklist_opcoes', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_checklist_opcoes_users')
            ->references('id')->on('users');

            $table->foreign('checklist_id','fk_checklist_opcoes_checklists')
            ->references('id')->on('checklists')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checklist_opcoes', function (Blueprint $table) {
            $table->dropForeign('fk_checklist_opcoes_users');
            $table->dropForeign('fk_checklist_opcoes_checklists');

        });
    }
};
