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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('forma_pagamento_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->decimal('valor', 9, 2)->nullable();
            $table->date('vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->unsignedTinyInteger('parcela');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
