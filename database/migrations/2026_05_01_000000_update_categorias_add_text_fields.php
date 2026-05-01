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
            // Altera o nome do campo existente
            $table->renameColumn('descricao', 'descricao_categoria');

            // Adiciona os novos campos
            $table->text('descricao')->nullable()->after('descricao_categoria');
            $table->text('defeito')->nullable()->after('descricao');
            $table->text('observacao')->nullable()->after('defeito');
            $table->text('laudo')->nullable()->after('observacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            // Remove os campos criados
            $table->dropColumn([
                'descricao',
                'defeito',
                'observacao',
                'laudo',
            ]);
            // Retorna o nome do campo para o original
            $table->renameColumn('descricao_categoria', 'descricao');
        });
    }
};
