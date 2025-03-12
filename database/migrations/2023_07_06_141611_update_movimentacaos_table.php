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
        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->foreign('produto_id', 'fk_movimentacaos_produtos')
                ->references('id')->on('produtos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->dropForeign('fk_movimentacaos_produtos');
        });
    }
};
