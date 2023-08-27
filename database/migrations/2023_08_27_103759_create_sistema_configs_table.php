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
        Schema::create('sistema_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->index()->unique();
            $table->string('value')->nullable();
            // $table->string('descricao')->nullable();
            // $table->string('model')->nullable();
            // $table->unsignedBigInteger('group_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistema_configs');
    }
};
