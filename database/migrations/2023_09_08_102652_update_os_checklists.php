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
        Schema::table('os_checklists', function (Blueprint $table) {
            $table->foreign('os_id', 'fk_os_checklists_os')
                    ->references('id')->on('os')
                    ->cascadeOnDelete();

            $table->foreign('user_id', 'fk_os_checklists_users')
                    ->references('id')->on('users');

            $table->foreign('checklist_id','fk_os_checklists_checklists')
                    ->references('id')->on('checklists')
                    ->cascadeOnDelete();

            $table->foreign('name','fk_os_checklists_checklist_opcoes')
                    ->references('name')->on('checklist_opcoes')
                    ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os_checklists', function (Blueprint $table) {
            $table->dropForeign('fk_os_checklists_os');
            $table->dropForeign('fk_os_checklists_users');
            $table->dropForeign('fk_os_checklists_checklists');
            $table->dropForeign('fk_os_checklists_checklist_opcoes');
        });
    }
};
