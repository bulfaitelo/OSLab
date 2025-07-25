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
        Schema::create('notificacaos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descricao')->nullable();
            $table->boolean('ativo')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('status_id');
            $table->string('assunto')->nullable();
            $table->text('conteudo_html')->nullable();
            $table->text('conteudo_texto')->nullable(); // texto simples sem html
            $table->char('tipo_gatilho'); // tipo de gatilho, por exemplo: atualização ou agendamento
            $table->integer('hora_gatilho')->nullable(); // hora do gatilho, se for agendamento
            $table->integer('dias_adiamento')->nullable(); // tempo necessário para o gatilho, se for agendamento
            $table->string('canal'); // canal de envio, por exemplo: email, sms, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacaos');
    }
};
