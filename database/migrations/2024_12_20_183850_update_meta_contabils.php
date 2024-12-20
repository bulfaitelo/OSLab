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
        Schema::table('meta_contabils', function (Blueprint $table) {
            $table->foreign('centro_custo_id', 'fk_meta_contabils_centro_custos')
            ->references('id')->on('centro_custos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meta_contabils', function (Blueprint $table) {
            $table->dropForeign('fk_meta_contabils_centro_custos');
        });
    }
};
