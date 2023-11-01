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
        Schema::create('emitentes', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18)->nullable();
            $table->string('name');
            $table->string('fantasia')->nullable();
            $table->string('porte')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('cep',10)->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('telefone')->nullable();
            $table->string('site_url')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('complemento')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emitentes');
    }
};
