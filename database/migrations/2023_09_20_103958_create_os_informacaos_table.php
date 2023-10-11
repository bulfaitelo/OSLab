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
        Schema::create('os_informacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('os_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('tipo'); // 1 anotação, 2 senha, 3 arquivo
            $table->string('descricao')->nullable();
            $table->string('tipo_informacao')->nullable();
            $table->string('informacao')->nullable();
            $table->uuid('uuid')->nullable();
            $table->timestamp('validade_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('os_informacaos');
    }
};
