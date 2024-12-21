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
        Schema::create('meta_contabils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descricao')->nullable();
            $table->unsignedBigInteger('centro_custo_id')->nullable();
            $table->decimal('valor', 9, 2);
            $table->boolean('valor_liquido')->default(0)->nullable();
            $table->string('intervalo');
            $table->boolean('exibir_dashboard')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_contabils');
    }
};
