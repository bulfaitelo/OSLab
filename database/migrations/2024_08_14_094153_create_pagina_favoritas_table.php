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
        Schema::create('pagina_favoritas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('route')->index();
            $table->string('text')->nullable();
            $table->foreign('user_id', 'fk_pagina_favoritas_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagina_favoritas');
    }
};
