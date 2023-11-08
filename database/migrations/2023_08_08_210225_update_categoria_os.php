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
        Schema::table('os_categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('checklist_id')->nullable();
            $table->boolean('checklist_required')->nullable()->default(0);
            $table->foreign('checklist_id', 'fk_os_categorias_checklists')
            ->references('id')->on('checklists');
        });

        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->foreign('os_id', 'fk_movimentacaos_os')
            ->references('id')->on('os');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os_categorias', function (Blueprint $table) {
            $table->dropForeign('fk_os_categorias_checklists');
            $table->dropColumn([
                'checklist_id',
                'checklist_required'
            ]);
        });

        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->dropForeign('fk_movimentacaos_os');
        });
    }
};
