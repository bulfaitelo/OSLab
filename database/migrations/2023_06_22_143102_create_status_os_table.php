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
        Schema::create('status_os', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->unsignedBigInteger('email_id')->nullable(); // email que vai ser usado para enviar
            $table->string('descricao')->nullable();
            $table->boolean('ativar_rastreio')->nullable()->default(0); // ativa o campo de rastreio dentro da OS (experimental)
            $table->boolean('ativar_email')->nullable()->default(0);
            $table->integer('prazo_email')->nullable(); // D + esse valor para ser enviado o email com esse status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_os');
    }
};
