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
        Schema::create('user_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->index();
            $table->json('value')->nullable();
            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->timestamps();
        });


        Schema::table('user_configs', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_user_configs_users')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_configs', function (Blueprint $table) {
            $table->dropForeign('fk_user_configs_users');
        });
        Schema::dropIfExists('user_configs');
    }
};
